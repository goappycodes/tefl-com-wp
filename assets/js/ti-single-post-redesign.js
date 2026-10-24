/* TEFL Institute — single blog post redesign (v2) interactions */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function ready(fn) {
    if (document.readyState !== 'loading') { fn(); }
    else { document.addEventListener('DOMContentLoaded', fn); }
  }

  ready(function () {
    var root = document.querySelector('.ti-blog-redesign');
    if (!root) { return; }

    /* Author bio — "Read full bio" expand/collapse */
    (function () {
      var bio = root.querySelector('.tibr-author__bio');
      var btn = root.querySelector('.tibr-author__readmore');
      if (!bio || !btn) { return; }
      // Only show the toggle if the bio is actually clamped/overflowing.
      if (bio.scrollHeight <= bio.clientHeight + 2) { btn.style.display = 'none'; return; }
      btn.addEventListener('click', function () {
        var expanded = bio.classList.toggle('is-expanded');
        btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        btn.textContent = expanded ? 'Show less' : 'Read full bio';
      });
    })();

    /* GA4 analytics via GTM dataLayer */
    (function () {
      window.dataLayer = window.dataLayer || [];
      var pid = root.getAttribute('data-post-id') || '';
      var ptitle = root.getAttribute('data-post-title') || '';
      var push = function (event, extra) {
        try {
          var d = { event: event, post_id: pid, post_title: ptitle };
          if (extra) { for (var k in extra) { if (Object.prototype.hasOwnProperty.call(extra, k)) { d[k] = extra[k]; } } }
          window.dataLayer.push(d);
        } catch (e) {}
      };
      root.querySelectorAll('.tibr-card').forEach(function (c) {
        var tool = (c.className.match(/tibr-card--(\w+)/) || [])[1] || 'unknown';
        c.addEventListener('click', function () { push('blog_tool_click', { tool: tool }); });
      });
      var promo = root.querySelector('.tibr-promo');
      if (promo) { promo.addEventListener('click', function () { push('blog_promo_click'); }); }
      var cta = root.querySelector('.tibr-cta-wrap a');
      if (cta) { cta.addEventListener('click', function () { push('blog_cta_click'); }); }
      var podcast = root.querySelector('.tibr-podcast');
      if (podcast) { podcast.addEventListener('click', function () { push('blog_podcast_click'); }); }
      var wireForm = root.querySelector('.tibr-wire__form');
      if (wireForm) { wireForm.addEventListener('submit', function () { push('blog_hirewire_submit'); }); }
      root.querySelectorAll('.tibr-share a').forEach(function (a) {
        a.addEventListener('click', function () {
          var net = (a.getAttribute('aria-label') || '').replace(/^Share on /, '') || 'copy-link';
          push('blog_share_click', { network: net });
        });
      });
    })();

    /* Reading progress bar */
    var bar = document.getElementById('tibrProgress');
    if (bar) {
      var onScroll = function () {
        var se = document.scrollingElement || document.documentElement;
        var max = se.scrollHeight - se.clientHeight;
        var p = max > 0 ? se.scrollTop / max : 0;
        bar.style.width = (Math.max(0, Math.min(1, p)) * 100) + '%';
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      window.addEventListener('resize', onScroll);
      onScroll();
    }

    /* Salary ticker — rotate items every 2.4s */
    var ticker = root.querySelector('[data-tibr-ticker]');
    if (ticker && !reduce) {
      var items = ticker.querySelectorAll('.tibr-ticker__item');
      if (items.length > 1) {
        var idx = 0;
        setInterval(function () {
          items[idx].classList.remove('is-on');
          idx = (idx + 1) % items.length;
          items[idx].classList.add('is-on');
        }, 2400);
      }
    }

    /* FAQ accordion — one open at a time */
    var faqs = root.querySelectorAll('.tibr-faq');
    faqs.forEach(function (faq) {
      var q = faq.querySelector('.tibr-faq__q');
      var sign = faq.querySelector('.tibr-faq__sign');
      if (!q) { return; }
      q.addEventListener('click', function () {
        var isOpen = faq.classList.contains('is-open');
        faqs.forEach(function (f) {
          f.classList.remove('is-open');
          var b = f.querySelector('.tibr-faq__q');
          if (b) { b.setAttribute('aria-expanded', 'false'); }
          var s = f.querySelector('.tibr-faq__sign');
          if (s) { s.innerHTML = '+'; }
        });
        if (!isOpen) {
          faq.classList.add('is-open');
          q.setAttribute('aria-expanded', 'true');
          if (sign) { sign.innerHTML = '−'; }
        }
      });
    });

    /* Copy link */
    var copy = root.querySelector('.tibr-copy');
    if (copy) {
      copy.addEventListener('click', function (e) {
        e.preventDefault();
        var url = copy.getAttribute('data-url') || window.location.href;
        var done = function () {
          var prev = copy.getAttribute('aria-label');
          copy.setAttribute('aria-label', 'Link copied');
          copy.classList.add('is-copied');
          setTimeout(function () {
            copy.setAttribute('aria-label', prev || 'Copy link');
            copy.classList.remove('is-copied');
          }, 1600);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(url).then(done).catch(done);
        } else {
          var ta = document.createElement('textarea');
          ta.value = url; document.body.appendChild(ta); ta.select();
          try { document.execCommand('copy'); } catch (err) {}
          document.body.removeChild(ta); done();
        }
      });
    }
  });
})();
