self.addEventListener('install', e => {
  console.log('PWA Service Worker installing.');
  let timeStamp = Date.now();
  e.waitUntil(caches.open('paperplane_photography_theme_service_worker').then(cache => {
    return cache.addAll([
      '../../style.min.css',
      '../../',
      '../../?utm_source=pwa-homescreen',
      '../js/theme-general.min.js',
      '../js/libs/infinite-scroll.pkgd.min.js',
      '../js/libs/masonry.pkgd.min.js',
      '../js/libs/swup.min.js',
      '../js/libs/SwupHeadPlugin.min.js',
      '../js/libs/SwupPreloadPlugin.min.js',
      '../js/libs/tocca.min.js',
    ]).then(() => self.skipWaiting());
  }))
});
self.addEventListener('activate', event => {
  console.log('PWA Service Worker activating.');
  event.waitUntil(self.clients.claim());
});
self.addEventListener('fetch', event => {
  event.respondWith(caches.match(event.request).then(response => {
    return response || fetch(event.request);
  }));
});