/* WELCOME exit-intent popup.
 * Desktop: the mouse leaves through the top of the window.
 * Phones and tablets (no mouse): a quick scroll back up after reading a while.
 * Shown at most once every 7 days, never again once the code is claimed.
 */
(function () {
  'use strict';

  /* Test mode: add ?wxtest=1 to any URL to see the popup after 1 second,
     ignoring the 8 second delay, the 7 day limit and any earlier claim. */
  var TEST = /[?&]wxtest=1\b/.test(location.search);

  var pop = document.getElementById('ti-wx');
  if (!pop) {
    /* The PHP normally prints the popup in the footer. If something on the
       page stops that from happening, build the same markup here instead. */
    var wrap = document.createElement('div');
    wrap.innerHTML =
      '<div class="ti-wx" id="ti-wx" hidden>' +
        '<div class="ti-wx__box" role="dialog" aria-modal="true" aria-labelledby="ti-wx-title" aria-describedby="ti-wx-text">' +
          '<button type="button" class="ti-wx__x" data-ti-wx-close aria-label="Close"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg></button>' +
          '<div class="ti-wx__view" data-ti-wx-view="offer">' +
            '<p class="ti-wx__eyebrow">Before you go</p>' +
            '<h2 class="ti-wx__title" id="ti-wx-title">Take 5% off your first course</h2>' +
            '<p class="ti-wx__text" id="ti-wx-text">Use this code at checkout on your first order with The TEFL Institute.</p>' +
            '<div class="ti-wx__code"><span class="ti-wx__codeval">WELCOME</span><button type="button" class="ti-wx__copy" data-ti-wx-copy>Copy</button></div>' +
            '<button type="button" class="ti-wx__btn" data-ti-wx-claim>Claim my 5% off</button>' +
            '<button type="button" class="ti-wx__no" data-ti-wx-close>No thanks</button>' +
            '<p class="ti-wx__fine">First order only. One use per customer. Cannot be combined with other codes.</p>' +
          '</div>' +
          '<div class="ti-wx__view" data-ti-wx-view="done" hidden>' +
            '<p class="ti-wx__eyebrow">Code saved</p>' +
            '<h2 class="ti-wx__title">5% off is on its way to your basket</h2>' +
            '<p class="ti-wx__text">WELCOME will be applied when you add a course. You will see the discount at checkout.</p>' +
            '<a class="ti-wx__btn" href="/tefl-courses-overview/">Browse courses</a>' +
            '<button type="button" class="ti-wx__no" data-ti-wx-close>Keep reading</button>' +
          '</div>' +
        '</div>' +
      '</div>';
    pop = wrap.firstChild;
    document.body.appendChild(pop);
    if (TEST && window.console) { console.info('WELCOME popup: footer markup was missing, built it from the script.'); }
  }
  if (TEST && window.console) { console.info('WELCOME popup: test mode, opening in 1 second.'); }

  var CFG = window.ti_wx || {};
  var KEY_SEEN = 'ti_wx_seen', KEY_CLAIMED = 'ti_wx_claimed';
  var WEEK = 7 * 24 * 60 * 60 * 1000;
  var MIN_TIME = 8000;              /* don't fire in the first 8 seconds on a page */
  var start = Date.now(), shown = false, lastFocus = null;

  function get(k) { try { return localStorage.getItem(k); } catch (e) { return null; } }
  function set(k, v) { try { localStorage.setItem(k, v); } catch (e) {} }

  function allowed() {
    if (shown) { return false; }
    if (TEST) { return true; }
    if (get(KEY_CLAIMED)) { return false; }
    var seen = parseInt(get(KEY_SEEN) || '0', 10);
    if (seen && Date.now() - seen < WEEK) { return false; }
    if (Date.now() - start < MIN_TIME) { return false; }
    if (document.querySelector('.lity-opened, .mfp-ready')) { return false; } /* another lightbox is open */
    return true;
  }

  function open() {
    if (!allowed()) { return; }
    shown = true;
    set(KEY_SEEN, String(Date.now()));
    lastFocus = document.activeElement;
    pop.hidden = false;
    document.documentElement.classList.add('ti-wx-lock');
    requestAnimationFrame(function () { pop.classList.add('is-open'); });
    var first = pop.querySelector('[data-ti-wx-claim]');
    if (first) { first.focus(); }
    track('ti_wx_shown');
  }

  function close() {
    pop.classList.remove('is-open');
    document.documentElement.classList.remove('ti-wx-lock');
    setTimeout(function () { pop.hidden = true; }, 200);
    if (lastFocus && lastFocus.focus) { lastFocus.focus(); }
  }

  function track(name) {
    try { (window.dataLayer = window.dataLayer || []).push({ event: name, coupon: 'WELCOME' }); } catch (e) {}
  }

  /* ---- Triggers ---- */
  var finePointer = window.matchMedia && window.matchMedia('(pointer: fine)').matches;

  if (TEST) { setTimeout(open, 1000); }

  if (finePointer) {
    /* Leaving the page through the top edge (towards tabs, address bar, close). */
    var onLeave = function (e) {
      if (e.relatedTarget || e.toElement) { return; }
      if (e.clientY <= 12) { open(); }
    };
    document.documentElement.addEventListener('mouseleave', onLeave);
    document.addEventListener('mouseout', onLeave);
  } else {
    var lastY = window.pageYOffset, lastT = Date.now(), maxY = 0;
    window.addEventListener('scroll', function () {
      var y = window.pageYOffset, t = Date.now();
      maxY = Math.max(maxY, y);
      /* a fast flick upwards (over 120px in under 350ms) after reading past 600px */
      if (maxY > 600 && lastY - y > 120 && t - lastT < 350) { open(); }
      if (t - lastT > 120) { lastY = y; lastT = t; }
    }, { passive: true });
  }

  /* ---- Actions ---- */
  pop.addEventListener('click', function (e) {
    if (e.target === pop || e.target.closest('[data-ti-wx-close]')) { close(); return; }

    var copy = e.target.closest('[data-ti-wx-copy]');
    if (copy) {
      var done = function () { copy.textContent = 'Copied'; setTimeout(function () { copy.textContent = 'Copy'; }, 2000); };
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText('WELCOME').then(done, done);
      } else { done(); }
      track('ti_wx_copied');
      return;
    }

    var claim = e.target.closest('[data-ti-wx-claim]');
    if (claim) {
      claim.disabled = true;
      set(KEY_CLAIMED, '1');
      track('ti_wx_claimed');
      var fd = new FormData();
      fd.append('action', 'ti_wx_claim');
      fetch(CFG.ajax, { method: 'POST', body: fd, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .catch(function () { return null; })
        .then(function () {
          pop.querySelector('[data-ti-wx-view="offer"]').hidden = true;
          var doneView = pop.querySelector('[data-ti-wx-view="done"]');
          doneView.hidden = false;
          var btn = doneView.querySelector('.ti-wx__btn');
          if (btn) { btn.focus(); }
        });
    }
  });

  document.addEventListener('keydown', function (e) {
    if (pop.hidden) { return; }
    if (e.key === 'Escape') { close(); return; }
    if (e.key === 'Tab') {
      var f = Array.prototype.filter.call(pop.querySelectorAll('button, a[href]'), function (el) { return el.offsetParent !== null; });
      if (!f.length) { return; }
      if (e.shiftKey && document.activeElement === f[0]) { e.preventDefault(); f[f.length - 1].focus(); }
      else if (!e.shiftKey && document.activeElement === f[f.length - 1]) { e.preventDefault(); f[0].focus(); }
    }
  });
})();