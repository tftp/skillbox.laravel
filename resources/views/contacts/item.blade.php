<div class="blog-post">
    <h4>{{ $contact->email }}</h4>
    <p class="blog-post-meta">{{ $contact->created_at->format('d.m.Y h:i:s') }}</p>
    <p>{{ $contact->message }}</p>
</div><!-- /.blog-post -->
