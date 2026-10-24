/* ==========================================================================
 * Black Friday Landing Page 2026 — teflinstitute.com
 * Interactions
 *
 * Section 1 (HERO) is entirely CSS/SVG-driven:
 *   - split-flap "BLACK FRIDAY IS LIVE" board  (CSS bf26Flap)
 *   - plane looping the dashed flight path       (SVG animateMotion + bf26Dash)
 *   - floating labels, 82% badge, clouds         (CSS bf26Pin / bf26Bubble / bf26Cloud)
 * So no JS is required for the hero yet.
 *
 * To come with later sections:
 *   - Countdown to the sale end date
 *   - Course-card strike-through on scroll into view
 *   - Free-gift suitcases (tap to unzip, "Open all" / "Re-wrap", confetti)
 *   - FAQ accordion (one open at a time)
 * ========================================================================== */
(function () {
  'use strict';

  function init() {
    // Hero needs no JS. Later-section initialisers will be wired up here.
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
