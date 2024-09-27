$(document).ready(function() {
    $('.reveal').on('click', function() {
        let couponCode = $(this).data('coupon-code');

        let tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(couponCode).select();
        document.execCommand('copy');
        tempInput.remove();

        let popup = $('#copy-popup');
        popup.find('strong').html(couponCode);

        popup.fadeIn(300).delay(1000).fadeOut(300)
    });
});