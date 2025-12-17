let postViewListenersAdded = false;

function initPostView() {
    console.log('Initializing post view scripts');

    console.log('listeners added: ',postViewListenersAdded);
    // Solo agregar listeners del formulario principal UNA VEZ
    if (!postViewListenersAdded) {
        
        // DELEGACIÓN: Escuchar clicks en document para elementos dinámicos
        document.addEventListener('click', function(e) {

            // TOGGLE FORMULARIO DE RESPUESTA
            // const replyBtn = e.target.closest('.reply');
            // if (replyBtn) {
            //     e.preventDefault();
            //     const commentId = replyBtn.getAttribute('data-comment-id');
            //     // Buscar el formulario dentro del mismo contenedor del comentario
            //     const commentContainer = replyBtn.closest('article') || replyBtn.closest('.comment-item');
            //     const form = commentContainer ? commentContainer.querySelector('.form') : document.querySelector(`.form[data-comment-id="${commentId}"]`);
            //     if (form) {
            //         form.classList.toggle('d-none');
            //     }
            //     return;
            // }

            // MOSTRAR/OCULTAR RESPUESTAS
            // const showRepliesBtn = e.target.closest('.show-replies');
            // if (showRepliesBtn) {
            //     const commentId = showRepliesBtn.getAttribute('data-comment-id');
            //     const repliesList = document.querySelector(`.replies[data-comment-id="${commentId}"]`);
            //     if (repliesList) {
            //         repliesList.classList.toggle('d-none');
            //         const spans = showRepliesBtn.querySelectorAll('span');
            //         spans.forEach(span => span.classList.toggle('d-none'));
            //     }
            //     return;
            // }
        });

        postViewListenersAdded = true;
    }
}

// Inicializar en carga inicial
document.addEventListener('DOMContentLoaded', initPostView);

// Re-inicializar cuando el contenido cambie (navegación SPA)
document.addEventListener('content-loaded', initPostView);