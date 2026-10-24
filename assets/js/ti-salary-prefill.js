/* Salary calculator — apply a choice handed off from a blog sidebar card and open the form.
   Additive: only acts when a ?tt= param is present. Does not change the tool's own logic. */
(function () {
  'use strict';
  jQuery(function ($) {
    var p = new URLSearchParams(window.location.search);
    var tt = p.get('tt');
    if (!tt) { return; }
    var country = p.get('country') || '';

    // Run after the tool's own ready handlers (which initially hide the form).
    setTimeout(function () {
      $('.info-text').hide();
      $('.single-page-form').show();

      var $radio = $('input[name="teaching-type"][value="' + tt + '"]');
      if ($radio.length) {
        $radio.prop('checked', true).trigger('change');
      }
      if (tt === 'Teaching Abroad') {
        $('.country-container').show();
        if (country) { $('input[name="country-text"]').val(country); }
      }

      var $form = $('.single-page-form');
      if ($form.length && $form.offset()) {
        $('html, body').animate({ scrollTop: $form.offset().top - 100 }, 600);
      }
    }, 700);
  });
})();
