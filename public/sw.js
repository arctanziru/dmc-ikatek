self.addEventListener('push', function (e) {
  if (!(self.Notification && self.Notification.permission === 'granted')) {
    return;
  }

  if (e.data) {
    var msg = e.data.json();
    console.log(msg)
    e.waitUntil(self.registration.showNotification(msg.title, {
      body: msg.body,
      icon: msg.icon,
      actions: msg.actions,
      data: msg.data
    }));
  }
});


self.addEventListener('notificationclick', function (e) {
  console.log(e)
  e.notification.close();
  e.waitUntil(clients.openWindow(e.notification.data));
})
