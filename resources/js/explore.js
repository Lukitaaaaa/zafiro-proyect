// User search functionality extracted from inline script in explore.blade.php
// Preserves existing jQuery AJAX implementation.

function setupUserSearch() {
    const searchInput = document.getElementById('search');
    const clearSearch = document.getElementById('clearSearch');

    searchInput.addEventListener('input', function () {
        clearSearch.className = this.value ? 'btn d-block' : 'd-none';
        consultaAjax(searchInput.value);
    });

    searchInput.addEventListener('blur', function () {
        const resultsContainer = document.getElementById('results');
        if (!resultsContainer) return;
        setTimeout(() => {
            resultsContainer.style.display = 'none';
        }, 200); // Delay to allow click on result
    });

    clearSearch.addEventListener('click', function () {
        searchInput.value = '';
        clearResults();
        clearSearch.style.display = 'none';
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
                    const linkElement = document.createElement('a');
                    linkElement.href = `/profile/${user.username}`;
                    linkElement.className = 'position-absolute w-100 h-100';

                    userElement.className = 'user-result p-2 d-flex align-items-center position-relative hover-secondary';
                    userElement.appendChild(image);
                    userElement.appendChild(nameContainer);
                    userElement.appendChild(linkElement);

                    resultsContainer.appendChild(userElement);
                });
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
}

function searchUsers() {
    const formSearch = document.getElementById('formSearch');
    formSearch.addEventListener('submit', function (e) {
        e.preventDefault();
        const query = document.getElementById('search').value;
        showUsersResults(query);
    });
}

function showUsersResults(query) {
    fetch(`/search-users?q=${encodeURIComponent(query)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const usersResultsContainer = document.getElementById('users-list');
            console.log('Fetched users:', data);
            usersResultsContainer.innerHTML = '';
            if (data.length === 0) {
                console.log('No users found');
                usersResultsContainer.style.display = 'none';
            } else {
                data.forEach(user => {
                    console.log('Rendering user:', user);
                    const userElement = document.createElement('div');
                    const colElement = document.createElement('div');
                    const image = document.createElement('img');
                    image.src = user.image;
                    image.alt = user.username;
                    image.className = 'avatar-img rounded-circle object-fit-cover mb-2';
                    image.width = 80;
                    image.height = 80;

                    const nameElement = document.createElement('span');
                    nameElement.textContent = user.name;
                    nameElement.className = 'd-block text-center text-truncate fw-bold';

                    const usernameElement = document.createElement('span');
                    usernameElement.textContent = `@${user.username}`;
                    usernameElement.className = 'd-block text-center text-truncate text-muted';

                    const linkElement = document.createElement('a');
                    linkElement.href = `/profile/${user.username}`;
                    linkElement.className = 'position-absolute w-100 h-100 top-0 start-0';

                    colElement.className = 'col';
                    colElement.appendChild(userElement);
                    userElement.className = 'user-card px-2 py-3 d-flex flex-column align-items-center position-relative';
                    userElement.appendChild(image);
                    userElement.appendChild(usernameElement);
                    userElement.appendChild(nameElement);
                    userElement.appendChild(linkElement);

                    usersResultsContainer.appendChild(colElement);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        })
        .finally(() => {
            clearResults();
        });

}

function clearResults() {
    const resultsContainer = document.getElementById('results');
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
        resultsContainer.style.display = 'none';
    }
}

function initExploreScripts() {
    setupUserSearch();
    searchUsers();
}


// Inicializar en carga inicial
document.addEventListener('DOMContentLoaded', initExploreScripts);

// Re-inicializar cuando el contenido cambie (navegación SPA)
document.addEventListener('content-loaded', initExploreScripts);
