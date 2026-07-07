<x-layouts.app>
    <section class="shop-hero">
        <div class="wrap">
            <div class="eyebrow">Vendor Online</div>
            <h1>THE <span>SHOP</span></h1>
            <p>Everything here is stuff I actually use — thumbnail packs, overlays, and merch, built the same way I
                build the channel. No filler.</p>
        </div>
    </section>
    <section>
        <div class="wrap">
            <div class="filter-bar">
                <button class="filter-btn is-active" data-filter="all">All Items</button>
                <button class="filter-btn" data-filter="digital">Digital Packs</button>
                <button class="filter-btn" data-filter="merch">Merch</button>
            </div>

            <div class="product-grid" id="productGrid">

                <div class="product-card cat-digital" data-cat="digital">
                    <div class="product-badge">Bestseller</div>
                    <div class="product-thumb p1">
                        <div class="product-icon">PSD</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Digital · Thumbnails</span>
                        <h3>"Blind Run" Thumbnail Pack Vol. 1</h3>
                        <p>20 editable thumbnail templates in the Respawn Forever style.</p>
                        <div class="product-footer">
                            <span class="product-price">$14</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="product-card cat-digital" data-cat="digital">
                    <div class="product-thumb p3">
                        <div class="product-icon">LUT</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Digital · Color</span>
                        <h3>Stylish Rank LUT Pack</h3>
                        <p>8 color presets for Premiere &amp; DaVinci, straight from my edits.</p>
                        <div class="product-footer">
                            <span class="product-price">$12</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="product-card cat-digital" data-cat="digital">
                    <div class="product-thumb p5">
                        <div class="product-icon">PNG</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Digital · Overlays</span>
                        <h3>Neon Grid Stream Overlay Pack</h3>
                        <p>Webcam frames, transitions &amp; alerts, cyberpunk-styled.</p>
                        <div class="product-footer">
                            <span class="product-price">$19</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="product-card cat-merch" data-cat="merch">
                    <div class="product-badge">New</div>
                    <div class="product-thumb p2">
                        <div class="product-icon">TEE</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Merch · Apparel</span>
                        <h3>Respawn Forever Logo Tee</h3>
                        <p>Heavyweight cotton, glitch-print logo on the chest.</p>
                        <div class="product-footer">
                            <span class="product-price">$28</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="product-card cat-merch" data-cat="merch">
                    <div class="product-thumb p4">
                        <div class="product-icon">HD</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Merch · Apparel</span>
                        <h3>"Style Rank S" Hoodie</h3>
                        <p>Oversized fit, embroidered rank badge on the sleeve.</p>
                        <div class="product-footer">
                            <span class="product-price">$52</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="product-card cat-merch" data-cat="merch">
                    <div class="product-thumb p6">
                        <div class="product-icon">STK</div>
                    </div>
                    <div class="product-meta">
                        <span class="product-cat">Merch · Stickers</span>
                        <h3>Mission Log Sticker Pack</h3>
                        <p>6 die-cut stickers, one per series in the archive.</p>
                        <div class="product-footer">
                            <span class="product-price">$8</span>
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="custom-teaser">
                <div>
                    <h3>Need Something Custom?</h3>
                    <p>Channel branding, thumbnails-for-hire, or a site like this one — I take on a limited number of
                        outside projects.</p>
                </div>
                <span class="custom-tag">Work With Me — Coming Soon</span>
            </div>
        </div>
    </section>
    <script>
        // filter bar
        (function() {
            var btns = document.querySelectorAll('.filter-btn');
            var cards = document.querySelectorAll('.product-card');
            btns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    btns.forEach(function(b) {
                        b.classList.remove('is-active');
                    });
                    btn.classList.add('is-active');
                    var filter = btn.getAttribute('data-filter');
                    cards.forEach(function(card) {
                        var match = filter === 'all' || card.getAttribute('data-cat') ===
                            filter;
                        card.style.display = match ? '' : 'none';
                    });
                });
            });
        })();

        // add to cart feedback + counter (UI only, no real cart)
        (function() {
            var count = 0;
            var cartLabel = document.querySelector('.cart-btn b');
            document.querySelectorAll('.add-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    count++;
                    if (cartLabel) cartLabel.textContent = '(' + count + ')';
                    var original = btn.textContent;
                    btn.textContent = 'Added ✓';
                    btn.classList.add('added');
                    setTimeout(function() {
                        btn.textContent = original;
                        btn.classList.remove('added');
                    }, 1200);
                });
            });
        })();

        // mobile menu
        (function() {
            var burger = document.getElementById('burgerBtn');
            var links = document.querySelector('.nav-links');
            burger.addEventListener('click', function() {
                var open = links.style.display === 'flex';
                links.style.display = open ? 'none' : 'flex';
                links.style.cssText +=
                    'position:fixed; top:64px; left:0; right:0; background:rgba(11,11,18,0.98); flex-direction:column; padding:24px 32px; gap:20px; border-bottom:1px solid rgba(242,240,245,0.1);';
            });
        })();
    </script>
</x-layouts.app>
