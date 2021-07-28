Echo
    .private('admin-channel')
    .listen('TestBroadcast', (e) => {
        alert(
            `Статья, id: ${e.id}\n\nИзменены поля: ${e.changes}\n\nСсылка: ${e.link}`
        );
    });
