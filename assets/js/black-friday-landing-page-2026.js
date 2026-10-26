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
 *   - Course-card strike-through on scroll into view
 *   - Free-gift suitcases (tap to unzip, "Open all" / "Re-wrap", confetti)
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

  function init() {
    initCountdown();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
