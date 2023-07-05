self.addEventListener('push', function (event) {
    console.log('[Service Worker] Push Received.');
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);
    var notificationData = event.data.text();
    var array = notificationData.split(', ');
    console.log(array);
    const title = array[0];
    const options = {
        body: array[1],
        icon: 'images/icon.png',
        badge: 'images/badge.png'
    };

    event.waitUntil(self.registration.showNotification(title, options));
});
