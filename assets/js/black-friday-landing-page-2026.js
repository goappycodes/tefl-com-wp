/* ==========================================================================
 * Black Friday Landing Page 2026 — teflinstitute.com
 * Interactions
 *
 * Section 1 (HERO) is entirely CSS/SVG-driven (split-flap board, plane path,
 * floating labels), so it needs no JS.
 *
 * Section: SALE COUNTDOWN — ticks down to the page's sale_end date.
 *   Mirrors the site's countdown approach (see assets/js/ti-timer.js):
 *   read an expiry string, new Date(expiry).getTime(), setInterval every 1s,
 *   compute days/hours/minutes/seconds. Here the markup is the Black Friday
 *   tile design and the expiry comes from data-sale-end on the clock wrapper.
 *
 * To come with later sections:
 * Section: FREE GIFTS — tap a suitcase to unzip and reveal the gift, with a
 *   progress counter, "Open all" / "Re-wrap" controls, a success banner and
 *   a little confetti burst. State is a single .is-open class per suitcase;
 *   the unzip choreography lives in CSS.
 *
 * To come with later sections:
 *   - FAQ accordion (one open at a time)
 * ========================================================================== */
(function () {
  'use strict';

  function pad(n) {
    return String(n).padStart(2, '0');
  }

  function initCountdown() {
    var wrap = document.querySelector('.bf26-countdown__inner');
    if (!wrap) {
      return;
    }
    var endStr = wrap.getAttribute('data-sale-end');
    var endTime = new Date(endStr).getTime();
    if (isNaN(endTime)) {
      return;
    }

    var out = {
      days: wrap.querySelector('[data-ct="days"]'),
      hrs:  wrap.querySelector('[data-ct="hrs"]'),
      mins: wrap.querySelector('[data-ct="mins"]'),
      secs: wrap.querySelector('[data-ct="secs"]')
    };

    function render() {
      var distance = endTime - Date.now();
      if (distance < 0) {
        distance = 0;
      }
      var days = Math.floor(distance / 86400000);
      var hrs  = Math.floor((distance % 86400000) / 3600000);
      var mins = Math.floor((distance % 3600000) / 60000);
      var secs = Math.floor((distance % 60000) / 1000);

      if (out.days) { out.days.textContent = pad(days); }
      if (out.hrs)  { out.hrs.textContent  = pad(hrs); }
      if (out.mins) { out.mins.textContent = pad(mins); }
      if (out.secs) { out.secs.textContent = pad(secs); }

      return distance;
    }

    render();
    var timer = setInterval(function () {
      if (render() <= 0) {
        clearInterval(timer);
      }
    }, 1000);
  }

  function initGifts() {
    var grid = document.querySelector('[data-gift-grid]');
    if (!grid) {
      return;
    }
    var gifts    = Array.prototype.slice.call(grid.querySelectorAll('[data-gift]'));
    var total    = gifts.length;
    var countEl  = document.querySelector('[data-gift-count]');
    var barEl    = document.querySelector('[data-gift-bar]');
    var banner   = document.querySelector('[data-gift-banner]');
    var openAll  = document.querySelector('[data-gift-openall]');
    var rewrap   = document.querySelector('[data-gift-rewrap]');
    var COLORS   = ['#D7263D', '#E3B341', '#F6F0EB', '#FF5C6C'];

    function update() {
      var n = grid.querySelectorAll('[data-gift].is-open').length;
      if (countEl) { countEl.textContent = n; }
      if (barEl)   { barEl.style.width = (total ? (n / total) * 100 : 0) + '%'; }
      if (banner)  { banner.hidden = n < total || total === 0; }
    }

    function burst(gift) {
      var bits = gift.querySelector('.bf26-gift__bits');
      if (!bits) { return; }
      for (var i = 0; i < 14; i++) {
        var a = (i / 14) * Math.PI * 2;
        var r = 70 + (i % 3) * 28;
        var s = document.createElement('span');
        s.className = 'bf26-bit';
        s.style.width  = (i % 2 ? 8 : 12) + 'px';
        s.style.height = (i % 2 ? 12 : 6) + 'px';
        s.style.background = COLORS[i % 4];
        s.style.setProperty('--dx', Math.round(Math.cos(a) * r) + 'px');
        s.style.setProperty('--dy', Math.round(Math.sin(a) * r - 20) + 'px');
        s.style.setProperty('--rot', ((i * 47) % 360) + 'deg');
        s.style.animationDelay = (0.9 + (i % 4) * 0.05) + 's';
        bits.appendChild(s);
        (function (node) { setTimeout(function () { node.remove(); }, 2600); })(s);
      }
    }

    function openGift(gift) {
      if (gift.classList.contains('is-open')) { return; }
      gift.classList.add('is-open');
      burst(gift);
      update();
    }

    function closeGift(gift) {
      gift.classList.remove('is-open');
      update();
    }

    gifts.forEach(function (gift) {
      gift.addEventListener('click', function () {
        if (gift.classList.contains('is-open')) {
          closeGift(gift);
        } else {
          openGift(gift);
        }
      });
    });

    if (openAll) {
      openAll.addEventListener('click', function () {
        gifts.forEach(openGift);
      });
    }
    if (rewrap) {
      rewrap.addEventListener('click', function () {
        gifts.forEach(closeGift);
      });
    }

    update();
  }

  /* Reviews: one card at a time, auto-advancing, swipeable. */
  function initReviews() {
    var scroll = document.querySelector('.bf26-review__scroll');
    if (!scroll) { return; }
    var cards = scroll.querySelectorAll('.bf26-review__card');
    if (cards.length < 2) { return; }
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }

    var idx = 0;
    var timer = null;
    var paused = false;
    var DELAY = 4500;

    function base() { return cards[0].offsetLeft; }

    function go(i) {
      idx = (i + cards.length) % cards.length;
      scroll.scrollTo({ left: cards[idx].offsetLeft - base(), behavior: 'smooth' });
    }

    function tick() { if (!paused) { go(idx + 1); } }

    function start() { stop(); timer = window.setInterval(tick, DELAY); }
    function stop() { if (timer) { window.clearInterval(timer); timer = null; } }

    // Keep idx in sync when the user swipes/scrolls manually.
    var settle;
    scroll.addEventListener('scroll', function () {
      window.clearTimeout(settle);
      settle = window.setTimeout(function () {
        var pos = scroll.scrollLeft + base();
        var best = 0, bestDist = Infinity;
        for (var i = 0; i < cards.length; i++) {
          var d = Math.abs(cards[i].offsetLeft - pos);
          if (d < bestDist) { bestDist = d; best = i; }
        }
        idx = best;
      }, 120);
    }, { passive: true });

    // Pause while the visitor is interacting.
    scroll.addEventListener('pointerenter', function () { paused = true; });
    scroll.addEventListener('pointerleave', function () { paused = false; });
    scroll.addEventListener('touchstart', function () { paused = true; }, { passive: true });
    scroll.addEventListener('touchend', function () {
      window.setTimeout(function () { paused = false; }, 2500);
    }, { passive: true });

    start();
  }

  /* FAQ accordion — one open at a time. */
  function initFaq() {
    var items = Array.prototype.slice.call(document.querySelectorAll('.bf26-faq__item'));
    if (!items.length) { return; }

    items.forEach(function (item) {
      var btn = item.querySelector('.bf26-faq__q');
      if (!btn) { return; }
      btn.addEventListener('click', function () {
        var isOpen = item.classList.contains('is-open');
        // Close every item first (one open at a time).
        items.forEach(function (other) {
          other.classList.remove('is-open');
          var b = other.querySelector('.bf26-faq__q');
          if (b) { b.setAttribute('aria-expanded', 'false'); }
        });
        // Toggle the clicked one.
        if (!isOpen) {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  function init() {
    initCountdown();
    initGifts();
    initReviews();
    initFaq();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
