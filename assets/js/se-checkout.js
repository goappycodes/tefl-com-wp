jQuery(document).ready(function($) {

    $('span.optional').remove();

    $(document).on('change', 'input[name="radio_choice"]', function(e) {
        var course_bought_by = $(this).val();
        if (course_bought_by === 'someone_else') {
            //$('#someone_else_checkout_field').show();
            $('#someone_else_checkout_field').attr('style', 'display:flex;');
            $('#se_first_name_field label, #se_last_name_field label, #se_email_field label, #se_password_field label, #se_phone_field label, #se_date_of_birth_field label').append('<abbr class="required" title="required">*</abbr>');
            $('#se_first_name_field, #se_last_name_field, #se_email_field, #se_password_field, #se_phone_field, #se_date_of_birth_field').addClass('validate-required');
        } else {
            $('#someone_else_checkout_field').hide();
            //$('#someone_else_checkout_field').attr('style', 'display:none;');
            $('#se_first_name_field label .required, #se_last_name_field label .required, #se_email_field label .required, #se_password_field label .required, #se_phone_field label .required, #se_date_of_birth_field label .required').remove();
            $('#se_first_name_field, #se_last_name_field, #se_email_field, #se_password_field, #se_phone_field, #se_date_of_birth_field').removeClass('validate-required');
        }
    })

});