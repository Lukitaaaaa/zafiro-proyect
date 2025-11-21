// User search functionality extracted from inline script in explore.blade.php
// Preserves existing jQuery AJAX implementation.

function setupUserSearch() {
    const searchInput = document.getElementById('search');
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        consultaAjax(searchInput.value);
    });

    searchInput.addEventListener('blur', function () {
        const resultsContainer = document.getElementById('results');
        if (!resultsContainer) return;
        setTimeout(() => {
            resultsContainer.style.display = 'none';
        }, 200); // Delay to allow click on result
    });
}

function consultaAjax(query) {
    const resultsContainer = document.getElementById('results');
    if (!resultsContainer) return;

    if (query.trim() === '') {
        resultsContainer.style.display = 'none';
        return;
    }

    if (typeof $ === 'undefined') {
        console.warn('jQuery not found: consider migrating to fetch API.');
        return;
    }

    $.ajax({
        url: '/search-users',
        type: 'GET',
        data: { q: query },
        success: function (data) {
            resultsContainer.innerHTML = '';
            if (!Array.isArray(data) || data.length === 0) {
                resultsContainer.style.display = 'none';
            } else {
                resultsContainer.style.display = 'block';
                data.forEach(user => {
                    const userElement = document.createElement('div');
                    const image = document.createElement('img');
                    image.src = user.image;
                    image.alt = user.username;
                    image.className = 'avatar-img rounded-circle object-fit-cover me-2';
                    image.width = 40;
                    image.height = 40;

                    const nameElement = document.createElement('span');
                    nameElement.textContent = user.name;
                    const usernameElement = document.createElement('span');
                    usernameElement.textContent = `@${user.username}`;

                    const nameContainer = document.createElement('div');
                    nameContainer.className = 'd-flex flex-column';
                    nameContainer.appendChild(nameElement);
                    nameContainer.appendChild(usernameElement);

                    userElement.className = 'user-result p-2 d-flex align-items-center hover-secondary';
                    userElement.appendChild(image);
                    userElement.appendChild(nameContainer);

                    resultsContainer.appendChild(userElement);
                    userElement.addEventListener('click', function () {
                        window.location.href = `/profile/${user.id}`;
                    });
                });
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
}

document.addEventListener('DOMContentLoaded', setupUserSearch);

// Optional future improvement: replace jQuery AJAX with fetch for consistency.
