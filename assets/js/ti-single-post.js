// Single Post JS

jQuery(document).ready(function($) {
    
    $(".widget-area").insertBefore(".category-links");
    const tableWrapper = $('.table-container-enhanced .table-wrapper');
    let isDragging = false;
    let startX = 0;
    let scrollLeft = 0;
    let startY = 0;
    let scrollTop = 0;

    tableWrapper.on('mousedown', function (e) {
        isDragging = true;
        tableWrapper.addClass('dragging');
        startX = e.pageX - tableWrapper.offset().left;
        scrollLeft = tableWrapper.scrollLeft();
        startY = e.pageY - tableWrapper.offset().top;
        scrollTop = tableWrapper.scrollTop();
        e.preventDefault();
    });

    $(document).on('mousemove', function (e) {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - tableWrapper.offset().left;
        const walkX = (x - startX) * 2;
        tableWrapper.scrollLeft(scrollLeft - walkX);

        const y = e.pageY - tableWrapper.offset().top;
        const walkY = (y - startY) * 1.5;
        tableWrapper.scrollTop(scrollTop - walkY);
    });

    $(document).on('mouseup mouseleave', function () {
        if (isDragging) {
            isDragging = false;
            tableWrapper.removeClass('dragging');
        }
    });

    tableWrapper.on('touchstart', function (e) {
        if (e.originalEvent.touches.length === 1) {
            const touch = e.originalEvent.touches[0];
            isDragging = true;
            tableWrapper.addClass('dragging');
            startX = touch.pageX - tableWrapper.offset().left;
            scrollLeft = tableWrapper.scrollLeft();
            startY = touch.pageY - tableWrapper.offset().top;
            scrollTop = tableWrapper.scrollTop();
        }
    });

    tableWrapper.on('touchmove', function (e) {
        if (!isDragging || e.originalEvent.touches.length !== 1) return;
        e.preventDefault();
        const touch = e.originalEvent.touches[0];
        const x = touch.pageX - tableWrapper.offset().left;
        const walkX = (x - startX) * 2;
        tableWrapper.scrollLeft(scrollLeft - walkX);

        const y = touch.pageY - tableWrapper.offset().top;
        const walkY = (y - startY) * 1.5;
        tableWrapper.scrollTop(scrollTop - walkY);
    });

    tableWrapper.on('touchend', function () {
        isDragging = false;
        tableWrapper.removeClass('dragging');
    });

    tableWrapper.on('selectstart', function (e) {
        if (isDragging) {
            e.preventDefault();
        }
    });

    tableWrapper.css('scroll-behavior', 'auto');
    
});