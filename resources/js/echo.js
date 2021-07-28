Echo
    .private('admin-channel')
    .listen('TestBroadcast', (e) => {
        alert(e.data);
    });
