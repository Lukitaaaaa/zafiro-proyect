const ICONS = {
    home: { off: "bi bi-house-door", on: "bi bi-house-door-fill" },
    search: { off: "bi bi-search", on: "bi bi-search" },
    heart: { off: "bi bi-heart", on: "bi bi-heart-fill" },
    plus: { off: "bi bi-plus-lg", on: "bi bi-plus-lg" },
    bell: { off: "bi bi-bell", on: "bi bi-bell-fill" },
    gear: { off: "bi bi-gear", on: "bi bi-gear-fill" },
};

function setActiveNav(route) {
	document.querySelectorAll(".nav-link").forEach((a) => {
		const iconKey = a.dataset.icon;
		const i = a.querySelector("i");
		const isActive = a.dataset.route === route;
		a.classList.toggle("active", isActive);
		if (iconKey && i)
			i.className = isActive ? ICONS[iconKey].on : ICONS[iconKey].off;
	});
}

function ensureProgressBar() {
    let bar = document.querySelector(".nav-progress-bar");
    if (!bar) {
        bar = document.createElement("div");
        bar.className = "nav-progress-bar";
        document.body.prepend(bar);
    }
    return bar;
}

function showProgress() {
    const bar = ensureProgressBar();
    bar.classList.add("active");
    bar.style.width = "0%";
    let pct = 0; // Resetea el porcentaje
    clearInterval(bar._timer); // Limpia cualquier animación previa (evita múltiples timers)
    bar._timer = setInterval(() => { // Inicia un intervalo que se ejecuta cada 150ms
        pct += Math.random() * 15; // Aumenta aleatoriamente entre 0-15%
        if (pct > 85) pct = 85; // Nunca pasa de 85% (hasta que cargue)
        bar.style.width = pct + "%"; // Actualiza el ancho visualmente
    }, 150);
}

function hideProgress() {
    const bar = document.querySelector(".nav-progress-bar");
    if (!bar) return;
    clearInterval(bar._timer);
    bar.style.width = "100%";
    setTimeout(() => { //  Esperar 400ms (tiempo para ver el 100%) antes de ocultar
        bar.classList.remove("active");
        bar.style.width = "0%";
    }, 400);
}

// Verifica si una URL es un enlace interno válido para SPA routing
function isInternalLink(url) { 
    try {
        const link = new URL(url, window.location.origin);
        return (
            link.origin === window.location.origin &&
            !url.includes("/logout") &&
            !url.includes("/login") &&
            !url.includes("/register") &&
            !url.match(/\.(jpg|jpeg|png|gif|pdf|zip|css|js)$/i)
        );
    } catch {
        return false;
    }
}

export function routeTo(event, route) {
    // console.log("Routing to:", route);
    event && event.preventDefault();
    showProgress();

    $.ajax({
        url: route,
        type: "GET",
        headers: { "X-Requested-With": "XMLHttpRequest" },
        success: function (response) {
            const $resp = $(response); // Convertir la respuesta en un objeto jQuery
            $("main").replaceWith($resp.find("main")); // Reemplazar solo el contenido principal
            history.pushState({}, "", route); // Actualizar la URL sin recargar
            setActiveNav(route); // Actualizar el estado del nav
            document.dispatchEvent(new Event("content-loaded")); // Disparar evento personalizado
        },
        error: function () {
			console.error("Error loading page:", route);
            window.location.href = route;
        },
        complete: hideProgress,
    });
}

function bindAllLinks() {
    // Usar delegación de eventos para capturar todos los clicks en enlaces
    document.addEventListener("click", function (e) {
        const link = e.target.closest("a");

        if (!link) return;

        const href = link.getAttribute("href");

        // Validar que sea un enlace interno válido
        if (
            !href ||
            href.startsWith("#") ||
            link.hasAttribute("data-no-spa") ||
            !isInternalLink(href)
        ) {
            return;
        }

        // Prevenir comportamiento por defecto y usar SPA routing
        e.preventDefault();
        routeTo(e, href);
    });
}

function initNav() {
    ensureProgressBar();
    bindAllLinks();
    setActiveNav(location.href);
    window.addEventListener("popstate", () => routeTo(null, location.href));
}

document.addEventListener("DOMContentLoaded", initNav);
// document.addEventListener('content-loaded', bindBannerLinks);