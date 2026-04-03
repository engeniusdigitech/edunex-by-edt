const CACHE_NAME = 'edunex-student-portal-v1';
const ASSETS_TO_CACHE = [
    '/student/login',
    '/build/assets/app-*.css', // Assuming Vite built assets
    '/build/assets/app-*.js',
    '/manifest.json',
    '/icons/icon-192x192.png',
    '/icons/icon-512x512.png'
];

// Install Event
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                // Add assets to cache, but don't fail installation if some assets are missing
                return Promise.all(
                    ASSETS_TO_CACHE.map(url => {
                        return fetch(url).then(response => {
                            if (!response.ok) {
                                throw new TypeError('Bad response status');
                            }
                            return cache.put(url, response);
                        }).catch(error => {
                            console.warn('Failed to cache:', url, error);
                        });
                    })
                );
            })
    );
});

// Activate Event (Cleanup Old Caches)
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});

// Fetch Event (Network First, fallback to Cache)
self.addEventListener('fetch', event => {
    // Only intercept basic navigation and asset requests, skip API calls
    if (event.request.method !== 'GET') return;

    event.respondWith(
        fetch(event.request)
            .then(response => {
                // Return fresh network data
                return response;
            })
            .catch(() => {
                // If offline, try serving from cache
                return caches.match(event.request).then(cachedResponse => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    // If not in cache and it's a page request, could return a specific offline page
                    if (event.request.mode === 'navigate') {
                        return caches.match('/student/login');
                    }
                });
            })
    );
});
