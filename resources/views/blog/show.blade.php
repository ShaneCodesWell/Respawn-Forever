<x-layouts.app>
    <div class="article-wrap">
        <section class="post-header">
            <div class="post-meta-row">
                <span>{{ $blogPost->published_at?->format('m.d.Y') }}</span>
                <span class="tag">{{ $blogPost->tag }}</span>
                <span>{{ $blogPost->read_time }} min read</span>
            </div>
            <h1 class="post-title">{{ $blogPost->title }}</h1>
            <div class="post-byline"><span class="byline-avatar"></span>Shane · Respawn Forever</div>
        </section>

        <div class="featured-image bp-img-ph {{ $blogPost->featured_image ? '' : 'ph1' }}"
            @if ($blogPost->featured_image) style="background-image:url('{{ $blogPost->featured_image_url }}')" @endif>
            @unless ($blogPost->featured_image)
                <span class="ph-icon">FEATURED IMG</span>
            @endunless
        </div>

        <section class="article">
            {{-- The RichEditor field saves real HTML (headings, bold, links, lists),
                 so this renders it as-is rather than escaping it as plain text.
                 That's why {!! !!} is used here instead of {{ }}. --}}
            {!! $blogPost->body !!}
        </section>

        <section class="post-footer">
            <div class="tag-list">
                <span class="tag-pill">{{ $blogPost->tag }}</span>
            </div>
            <div class="share-row">
                <a href="#">Share</a>
                <a href="#"
                    onclick="navigator.clipboard.writeText(window.location.href); this.textContent='Copied!'; return false;">Copy
                    Link</a>
            </div>
        </section>
    </div>

    @if ($related->isNotEmpty())
        <section class="related">
            <div class="wrap">
                <h2 class="related-title">More From The Debrief</h2>
                <div class="related-grid">
                    @foreach ($related as $relatedPost)
                        <a href="{{ route('blog.show', $relatedPost) }}" class="related-card">
                            <div class="bp-img-ph {{ $relatedPost->featured_image ? '' : 'ph' . (($loop->index % 4) + 1) }}"
                                @if ($relatedPost->featured_image) style="background-image:url('{{ $relatedPost->featured_image_url }}')" @endif>
                                @unless ($relatedPost->featured_image)
                                    <span class="ph-icon">IMG</span>
                                @endunless
                            </div>
                            <div class="related-body">
                                <h3>{{ $relatedPost->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
