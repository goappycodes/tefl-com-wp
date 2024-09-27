jQuery(document).ready(function ($) {

    // Image gallery
    var thumbnails = jQuery('.thumbnail');
    var mainImage = jQuery('.large-image');
    var prevArrow = jQuery('.prev-arrow');
    var nextArrow = jQuery('.next-arrow');
    var currentIndex = 0;

    function updateMainImage(index) {
        currentIndex = index;
        var selectedThumbnail = thumbnails.eq(index);
        var largeImageUrl = selectedThumbnail.data('large-image');
        var altText = selectedThumbnail.attr('alt');
        mainImage.css('background-image', 'url(' + largeImageUrl + ')').attr('alt', altText);

        thumbnails.removeClass('active-thumbnail');

        selectedThumbnail.addClass('active-thumbnail');
    }

    thumbnails.on('click', function() {
        updateMainImage(jQuery(this).index('.thumbnail'));
    });

    prevArrow.on('click', function() {
        currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
        updateMainImage(currentIndex);
    });

    nextArrow.on('click', function() {
        currentIndex = (currentIndex + 1) % thumbnails.length;
        updateMainImage(currentIndex);
    });

    updateMainImage(0);

    // Step cards
    let color = '#267481';
    let colorRGB = ThemeService.hexToRgb(color.trim());

    let htmlBlocks = $('.step');
    let colorStep = .1;
    ThemeService.setBgColor(colorRGB, colorStep, htmlBlocks, 'decreasing');

    htmlBlocks.hover(
        function() {
            let bgImage = $(this).data('bg');
            $(this).css({
                'background-image': 'url(' + bgImage + ')',
                'background-blend-mode': 'soft-light'
            });
        },
        function() {
            $(this).css({
                'background-image': '',
                'background-blend-mode': ''
            });
        }
    );

    htmlBlocks = $('.two-blocks>div');
    colorStep = .2;
    ThemeService.setBgColor(colorRGB, colorStep, htmlBlocks, 'decreasing');
});