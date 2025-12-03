function initPostView() {
    // Verificar que estamos en la vista del post
    console.log('Initializing post view scripts');
    const commentForm = document.querySelector('form[action*="comments"]');
    if (!commentForm) {
        console.log('Not on post view, skipping initialization');
        return;
    }

    // HABILITAR EL BOTON DE RESPONDER CUANDO SE ESCRIBE EN EL INPUT
    const button = document.getElementById('add-comment-btn');
    const input = document.getElementById('content');

    if (button && input) {
        button.disabled = input.value.trim() === '';

        input.addEventListener('input', () => {
            button.disabled = input.value.trim() === '';
        });

        commentForm.addEventListener('submit', function () {
            button.disabled = true;
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('spinner');
            if (buttonText) buttonText.classList.add('d-none');
            if (spinner) spinner.classList.remove('d-none');
        });
    }

    // MOSTRAR Y OCULTAR EL FORMULARIO DE RESPUESTA
    const toggleForm = document.querySelectorAll('.reply');
    const formReply = document.querySelectorAll('.form');

    toggleForm.forEach((reply, index) => { 
        reply.addEventListener('click', function() {
            if (formReply[index]) {
                formReply[index].classList.toggle('d-none');
            }
        });
    });

    // HABILITAR LOS BOTONES DE RESPONDER CUANDO SE ESCRIBE EN EL INPUT CORRESPONDIENTE
    const addReplyBtn = document.querySelectorAll('#add-reply-btn');
    const inputReply = document.querySelectorAll('#content-reply');
    
    addReplyBtn.forEach((btn, index) => {
        if (inputReply[index]) {
            btn.disabled = inputReply[index].value.trim() === '';
        }
    });

    inputReply.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (addReplyBtn[index]) {
                addReplyBtn[index].disabled = input.value.trim() === '';
            }
        });
    });

    formReply.forEach((form, index) => {
        form.addEventListener('submit', function () {
            if (addReplyBtn[index]) {
                addReplyBtn[index].disabled = true;
                const buttonText = form.querySelector('#button-text');
                const spinner = form.querySelector('#spinner');
                if (buttonText) buttonText.classList.add('d-none');
                if (spinner) spinner.classList.remove('d-none');
            }
        });
    });

    // MOSTRAR Y OCULTAR LAS RESPUESTAS
    const showReplies = document.querySelectorAll('.show-replies');
    
    showReplies.forEach(show => {
        show.addEventListener('click', function() {
            const commentId = show.getAttribute('data-comment-id');
            const repliesList = document.querySelector(`.replies[data-comment-id="${commentId}"]`);
            if (repliesList) {
                repliesList.classList.toggle('d-none');
                const spans = show.querySelectorAll('span');
                spans.forEach(span => span.classList.toggle('d-none'));
            }
        });
    });
}

// Inicializar en carga inicial
document.addEventListener('DOMContentLoaded', initPostView);

// Re-inicializar cuando el contenido cambie (navegación SPA)
document.addEventListener('content-loaded', initPostView);