function initInfiniteScroll() {
    const container = document.querySelector('[data-infinite-scroll-container]');
    if (!container || container.dataset.infiniteScrollBound) return;
    container.dataset.infiniteScrollBound = 'true';

    let page = 1;
    let loading = false;
    let hasMore = container.getAttribute('data-has-more') === 'true';

    // Create HTML loader at the end of the container
    const loader = document.createElement('div');
    loader.className = 'text-center my-4 py-3 w-100 d-none';
    loader.innerHTML = `
        <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
    `;
    container.appendChild(loader);

    if (hasMore) {
        loader.classList.remove('d-none');
    }

    const loadMorePosts = () => {
        if (loading || !hasMore) return;
        loading = true;

        page++;
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-Infinite-Scroll': 'true' // Custom header to avoid SPA router clash
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.html) {
                // Insert posts right before the loader element (keeping the loader at the bottom)
                loader.insertAdjacentHTML('beforebegin', data.html);
            }
            hasMore = data.hasMore;
            loading = false;

            if (!hasMore) {
                loader.classList.add('d-none');
                observer.disconnect();
            }
        })
        .catch(err => {
            console.error('Error loading posts:', err);
            loading = false;
        });
    };

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && hasMore) {
            loadMorePosts();
        }
    }, {
        rootMargin: '200px'
    });

    observer.observe(loader);
}

// Bind to DOMContentLoaded for normal page loads, and content-loaded for SPA navigation
document.addEventListener('DOMContentLoaded', initInfiniteScroll);
document.addEventListener('content-loaded', initInfiniteScroll);
