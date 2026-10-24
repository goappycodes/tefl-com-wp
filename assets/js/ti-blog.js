jQuery(document).ready(function($) {
    let offset = 0;
    let typingTimer;
    let currentRequest = null;
    const doneTypingInterval = 400; 

    const $input = $('#blog-live-search');
    const $container = $('#search-results-container');
    const $btn = $('#load-more-btn');

    $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {
            offset = 0;
            fetchBlogs(false);
        }, doneTypingInterval);
    });

    $btn.on('click', function(e) {
        e.preventDefault();
        offset += 3;
        fetchBlogs(true);
    });

    function fetchBlogs(append) {
        if (currentRequest != null) currentRequest.abort();
        
        currentRequest = $.ajax({
            url: ti_obj.ti_ajax,
            type: 'POST',
            data: {
                action: 'blog_live_search',
                query: $input.val(),
                offset: offset
            },
            beforeSend: function() {
                if (!append) $container.css('opacity', '0.5');
                $btn.text('LOADING...').prop('disabled', true);
            },
            success: function(response) {
                currentRequest = null;
                $container.css('opacity', '1');
                $btn.prop('disabled', false);

                if (append) {
                    $container.append(response);
                } else {
                    $container.html(response);
                }

                if ($('#has-more-posts').length > 0) {
                    $btn.show().text('LOAD MORE');
                    $('#has-more-posts').remove();
                } else {
                    $btn.hide();
                }
            }
        });
    }
});