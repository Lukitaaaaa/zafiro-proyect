@extends('layout.layout')

@section('content')
<style>
    .hover-secondary:hover {
        background-color: var(--bs-secondary); /* Usa la variable de Bootstrap para el color secundario */
        color: white; /* Cambia el texto a blanco para mejor contraste */
        cursor: pointer; /* Cambia el cursor a pointer para indicar que es interactivo */
    }
</style>
<main class="d-flex flex-row w-100" style="margin-left: 240px;">
    
    <div class="feed mx-auto">
        <div class="container py-3" style="width: 895px;">
            <div class="mb-4 position-relative">
                <form action="" method="GET" class="d-flex" role="search">
                    <input
                        type="text"
                        name="q"
                        id="search"
                        class="form-control rounded-pill me-2"
                        placeholder="Search users..."
                        value="{{ request('q') }}"
                        autocomplete="off"
                    >
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </form>
                <div id="results" class="mt-3 z-3 position-absolute bg-body border rounded shadow" style="display:none; width: 100%; max-height: 450px; overflow-y: auto;">
                    {{-- @if(request('q'))
                        @foreach($users as $user)
                            <div class="user-result p-2 border-bottom">
                                <a href="{{ route('profile.show', $user->username) }}" class="text-decoration-none text-dark">
                                    {{ $user->username }}
                                </a>
                            </div>
                        @endforeach --}}
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 gap-2 mx-auto">
                @foreach ($posts as $post)
                    <div class="columna col">
                        @include('components.post-card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function (){
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', function () {
            consultaAjax(searchInput.value);
        });

        // searchInput.addEventListener('focus', function () {
        //     const resultsContainer = document.getElementById('results');
        //     resultsContainer.style.display = 'block';
        // });

        searchInput.addEventListener('blur', function () {
            const resultsContainer = document.getElementById('results');
            setTimeout(() => {
                resultsContainer.style.display = 'none';
            }, 200); // Delay to allow click on result
        });
    })

    function consultaAjax(query)
    {
        if (query.trim() === '') {
            const resultsContainer = document.getElementById('results');
            resultsContainer.style.display = 'none';
            return;
        }
        $.ajax({
            url: '/search-users',
            type: 'GET',
            data: { q: query },
            success: function (data) {
                const resultsContainer = document.getElementById('results');
                resultsContainer.innerHTML = ''; // Limpiar resultados anteriores
                if (data.length === 0) {
                    resultsContainer.style.display = 'none'; // Ocultar si no hay resultados
                } else {
                    resultsContainer.style.display = 'block'; // Mostrar resultados
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
                        console.log(user);
                        userElement.addEventListener('click', function () {
                            window.location.href = `/profile/${user.id}`;
                        });
                    });
                    //console.log(data);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
</script>
@endsection
