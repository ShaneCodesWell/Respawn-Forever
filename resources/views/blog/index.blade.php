<x-layouts.app>

    <section class="blog-hero">
        <div class="wrap">
            <div class="eyebrow">Off The Record</div>
            <h1>The Debrief</h1>
            <p>Not everything needs a 20-minute video. This is where the opinions, hot takes, and half-formed thoughts
                go instead.</p>
        </div>
    </section>

    @if ($featured)
        <section class="featured">
            <div class="wrap">
                {{-- route() needs ONE model, not the $posts collection --}}
                <a href="{{ route('blog.show', $featured) }}" class="featured-card">
                    <div class="featured-img img-ph {{ $featured->featured_image ? '' : 'ph1' }}"
                        @if ($featured->featured_image) style="background-image:url('{{ $featured->featured_image_url }}')" @endif>
                        @unless ($featured->featured_image)
                            <span class="ph-icon">IMG</span>
                        @endunless
                    </div>
                    <div class="featured-content">
                        <div class="post-meta">
                            <span>{{ $featured->published_at?->format('m.d.Y') }}</span>
                            <span class="tag">{{ $featured->tag }}</span>
                        </div>
                        <h2>{{ $featured->title }}</h2>
                        <p>{{ $featured->excerpt }}</p>
                        <span class="read-more">Read Full Post →</span>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <section>
        <div class="wrap">
            <div class="post-grid">
                @forelse ($posts as $post)
                    {{-- $post here is a single model from the loop — this is what was missing --}}
                    <a href="{{ route('blog.show', $post) }}" class="post-card">
                        <div class="img-ph {{ $post->featured_image ? '' : 'ph' . (($loop->index % 4) + 1) }}"
                            @if ($post->featured_image) style="background-image:url('{{ $post->featured_image_url }}')" @endif>
                            @unless ($post->featured_image)
                                <span class="ph-icon">IMG</span>
                            @endunless
                        </div>
                        <div class="post-body">
                            <div class="post-meta">
                                <span>{{ $post->published_at?->format('m.d.Y') }}</span>
                                <span class="tag">{{ $post->tag }}</span>
                            </div>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->excerpt }}</p>
                            <span class="read-more">Read More →</span>
                        </div>
                    </a>
                @empty
                    <p style="color:var(--muted);">No posts yet — add one from /admin to see it here.</p>
                @endforelse
            </div>
        </div>
    </section>

</x-layouts.app>
