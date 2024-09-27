jQuery(document).ready(function ($) {
    if ($(".countdown-timer").length) {
        $('.countdown-timer').displayCountdown();
    }
    if (matchMedia('(min-width: 768px)').matches) {
        $('.job-section-new').find('.job-card__body').equalizeHeights();
        let stepColumns = $('.steps-column');
        stepColumns.equalizePairHeights();
    }

    $('.guide-download').on('click', function (e) {
        e.preventDefault();
        let form = $('.guide-donwnload-form');
        form.toggleClass('hidden');
    })
    $(document).on('wpcf7mailsent', function (event) {
        window.open('https://teflinstitute.com/wp-content/uploads/2023/01/Teaching-English-Online-Guide.pdf');
    });

    let accent = getComputedStyle(document.documentElement).getPropertyValue('--accent');
    let accentColorRGB = ThemeService.hexToRgb(accent.trim());

    let midContentBlocks = $('.mid-content');
    let colorStep = .05;
    ThemeService.setBgColor(accentColorRGB, colorStep, midContentBlocks, 'decreasing');





});