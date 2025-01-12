const CACHE_NAME = "meu-app-cache-v2"; // Alterar o nome do cache força o navegador a buscar os arquivos novamente
const urlsToCache = [
    "/",
    "/manifest.json",
    "/css/app.css",
    "/js/app.js",
    "/unicorn.png",
    
];

self.addEventListener("install", event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
    );
});

self.addEventListener("activate", event => {
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

