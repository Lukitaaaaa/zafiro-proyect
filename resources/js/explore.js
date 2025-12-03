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
    const usersResults = document.getElementById('btnSearch');
    if (!usersResults) return;
    console.log('Search button found, binding event listener');
    usersResults.addEventListener('click', function (e) {
        e.preventDefault();
        console.log('Search button clicked');
        const query = document.getElementById('search').value;
        console.log('Searching for:', query);
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
                usersResultsContainer.style.display = 'block';
                data.forEach(user => {
                    console.log('Rendering user:', user);
                    const userElement = document.createElement('div');
                    const image = document.createElement('img');
                    image.src = user.image;
                    image.alt = user.username;
                    image.className = 'avatar-img rounded-circle object-fit-cover mb-2';
                    image.width = 80;
                    image.height = 80;

                    const nameElement = document.createElement('span');
                    nameElement.textContent = user.name;

                    const linkElement = document.createElement('a');
                    linkElement.href = `/profile/${user.username}`;
                    linkElement.className = 'position-absolute w-100 h-100';

                    userElement.className = 'user-result p-2 d-flex flex-column align-items-center position-relative';
                    userElement.appendChild(image);
                    userElement.appendChild(nameElement);
                    userElement.appendChild(linkElement);

                    usersResultsContainer.appendChild(userElement);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });

}

function clearResults() {
    const resultsContainer = document.getElementById('results');
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
        resultsContainer.style.display = 'none';
    }
}
// function searchUsers(query) {
//     return fetch(`/search-users?q=${encodeURIComponent(query)}`)
//         .then(response => {
//             console.log('Fetch response:', response);
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .catch(error => {
//             console.error('Error fetching users:', error);
//             return [];
//         });
// }

function initExploreScripts() {
    setupUserSearch();
    searchUsers();
}


// Inicializar en carga inicial
document.addEventListener('DOMContentLoaded', initExploreScripts);

// Re-inicializar cuando el contenido cambie (navegación SPA)
document.addEventListener('content-loaded', initExploreScripts);
