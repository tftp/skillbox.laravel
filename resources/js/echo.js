Echo
    .channel('testing')
    .listen('TestBroadcast', (e) => {
        alert(e.data);
    });
