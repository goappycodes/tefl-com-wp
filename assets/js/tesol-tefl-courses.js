$(document).ready(function () {

    function setInitialHeight(expandable, height) {
        let isExpanded = expandable.hasClass('expanded');
        let initialHeight = isExpanded ? expandable[0].scrollHeight : height;
        expandable.css('height', initialHeight + 'px');
    }

    function toggleExpandable(expandable, duration, height, expandText, collapseText) {
        let isExpanded = expandable.hasClass('expanded');

        if (isExpanded) {
            expandable.animate({
                height: height + 'px'
            }, duration, function () {
                expandable.removeClass('expanded');
                expandable.next().find('span').text(expandText);
            });
        } else {
            expandable.addClass('expanded');
            expandable.animate({
                height: expandable[0].scrollHeight + 'px'
            }, duration, function () {
                expandable.next().find('span').text(collapseText);
            });
        }
    }

    let initialCtaHeight = 70;
    let expandableCTA = $('.key-card-summary');
    setInitialHeight(expandableCTA, initialCtaHeight);

    $('.expandable-card').on('click', function () {
        let expandable = $(this).prev();
        let duration = 500;
        let expandText = 'Show More';
        let collapseText = 'Show Less';

        toggleExpandable(expandable, duration, initialCtaHeight, expandText, collapseText);
    });

    // equalize section

    function equalizeHeightsForDesktop() {
        if (window.matchMedia("(min-width: 769px)").matches) {
            $('.key-card-title').equalizeHeights();
        }
    }

    equalizeHeightsForDesktop();

    window.addEventListener('resize', equalizeHeightsForDesktop);

});