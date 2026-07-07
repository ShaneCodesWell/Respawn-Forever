//
// combo counter + stylish rank ticker (signature interaction)
(function () {
    var countEl = document.getElementById('comboCount');
    var rankEl = document.getElementById('comboRank');
    var navRankEl = document.getElementById('navRank');
    var ranks = ['D', 'C', 'B', 'A', 'S', 'SSS'];
    var hits = 0, rankIdx = 0;
    setInterval(function () {
        hits += Math.floor(Math.random() * 4) + 1;
        if (hits > 60) hits = 0;
        countEl.innerHTML = String(hits).padStart(2, '0') + '<span>HITS</span>';
        rankIdx = Math.min(ranks.length - 1, Math.floor(hits / 12));
        rankEl.textContent = ranks[rankIdx];
        if (navRankEl) navRankEl.textContent = ranks[rankIdx];
    }, 900);
})();

// mobile menu toggle
(function () {
    var burger = document.getElementById('burgerBtn');
    var links = document.querySelector('.nav-links');
    burger.addEventListener('click', function () {
        var open = links.style.display === 'flex';
        links.style.display = open ? 'none' : 'flex';
        links.style.cssText += 'position:fixed; top:64px; left:0; right:0; background:rgba(11,11,18,0.98); flex-direction:column; padding:24px 32px; gap:20px; border-bottom:1px solid rgba(242,240,245,0.1);';
    });
})();

// scroll reveal
(function () {
    var items = document.querySelectorAll('.reveal');
    var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) { entry.target.classList.add('is-visible'); obs.unobserve(entry.target); }
        });
    }, { threshold: 0.15 });
    items.forEach(function (item) { obs.observe(item); });
})();