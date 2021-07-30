Echo
    .private('admin-channel')
    .listen('ArticleUpdateBroadcast', (e) => {
        alert(
            `Статья, id: ${e.id}\n\nИзменены поля: ${e.changes}\n\nСсылка: ${e.link}`
        );
    });
