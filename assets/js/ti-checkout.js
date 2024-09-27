jQuery(document).ready(function($){
    if ($('body').hasClass('logged-in')) {
        $billing_email = $('#billing_email').val();
        if ($billing_email !== '') {
            $('#billing_email').attr('readonly', true);
        }
    }
})