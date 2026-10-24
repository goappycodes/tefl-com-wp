jQuery('document').ready(function ($) {
    // Klarna Modal

    let klarnaModal = $("#klarnaModal");
    let closeButton= $(".close");

    $(".klarna-learn-more").click(function() {
        let price =$(this).data('full-price');
        $('.installment-price').text(price);
        klarnaModal.css("display", "block");
        klarnaModal.animate({ opacity: "1" }, 500);
    });

    
    closeButton.click(function(e) {
        e.preventDefault();
        klarnaModal.animate({ opacity: "0" }, 500, function() {
        klarnaModal.css("display", "none");
        });
    });

    $(window).click(function(event) {
        if (event.target == klarnaModal[0]) {
        klarnaModal.animate({ opacity: "0" }, 500, function() {
            klarnaModal.css("display", "none");
        });
        }
    });
});