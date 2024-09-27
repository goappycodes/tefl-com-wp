jQuery(document).ready(function($) {

    const urlParams = new URLSearchParams(window.location.search)
    for (const [key, value] of urlParams) {
        var usertype = '';
        var userpreference = '';
        var userlevel = '';
        var userqual = '';

        if (key == 'usertype') {
            usertype = value;
        } else if (key == 'userpreference') {
            userpreference = value;
        } else if (key == 'userlevel') {
            userlevel = value;
        } else if (key == 'userqual') {
            userqual = value;
        }

        if (usertype !== '') {
            $("#user_type option:contains(" + usertype + ")").prop('selected', true);
        }
        if (userpreference !== '') {
            $("#user_preference option:contains(" + userpreference + ")").prop('selected', true);
        }
        if (userlevel !== '') {
            $("#user_level option:contains(" + userlevel + ")").prop('selected', true);
        }
        if (userqual !== '') {
            $("#user_qualification option:contains(" + userqual + ")").prop('selected', true);
        }
    }

    $(document).on('click', '.tefl-search-btn', function(e) {
        e.preventDefault();
        var user_type = $('#user_type option:selected').text();
        var user_preference = $('#user_preference option:selected').text();
        var user_level = $('#user_level option:selected').text();
        var user_qualification = $('#user_qualification option:selected').text();
        window.location.href = "/search-courses?usertype=" + user_type + "&userpreference=" + user_preference + "&userlevel=" + user_level + "&userqual=" + user_qualification;
    })

    if ($('.course-result-row').children('div').hasClass('course-row')) {
        $('html, body').animate({
            scrollTop: $("#course_result_section").offset().top
        }, 2000);
    }

})