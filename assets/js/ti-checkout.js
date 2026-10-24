jQuery(document).ready(function($){
    if ($('body').hasClass('logged-in')) {
        $billing_email = $('#billing_email').val();
        if ($billing_email !== '') {
            $('#billing_email').attr('readonly', true);
        }
    }

    //Hope foundation donation functions

    var lastSelectedDonation = $("#hope_foundation_donation").val();
    
    $(document).on("change", "#hope_foundation_donation", function() {
        var donationAmount = $(this).val();
        lastSelectedDonation = donationAmount;
        
        $("body").trigger("update_checkout", {
            update_shipping_method: false
        });
        
        if (donationAmount && donationAmount > 0) {
            var selectedText = $(this).find("option:selected").text();
            console.log("Donation selected: " + selectedText);
        } else {
            console.log("Donation cleared");
        }
    });
    
    $(document).on("change", "#billing_country", function() {
        setTimeout(function() {
            console.log("Country changed, updating checkout");
            $("body").trigger("update_checkout");
        }, 300);
    });

    $(document.body).on("updated_checkout", function() {
        setTimeout(function() {
            var currentSelection = $("#hope_foundation_donation").val();
            
            if (!currentSelection && lastSelectedDonation) {
                $("#hope_foundation_donation").val(lastSelectedDonation);
                console.log("Restored donation selection: " + lastSelectedDonation);
            } else if (currentSelection) {
                lastSelectedDonation = currentSelection;
                console.log("Checkout updated, donation preserved: " + currentSelection);
            }
            
            var feeExists = $(".hope-donation-line-item").length > 0 || 
                          $("tr:contains('Hope Foundation Donation')").length > 0;
            console.log("Donation fee in review table: " + (feeExists ? "YES" : "NO"));
        }, 100);
    });
    
    $(window).on("beforeunload", function() {
        var selectedDonation = $("#hope_foundation_donation").val();
        if (selectedDonation) {
            sessionStorage.setItem('hope_foundation_backup', selectedDonation);
        }
    });
    
    $(window).on("load", function() {
        if (!$("#hope_foundation_donation").val()) {
            var backupDonation = sessionStorage.getItem('hope_foundation_backup');
            if (backupDonation) {
                $("#hope_foundation_donation").val(backupDonation);
                console.log("Restored donation from sessionStorage: " + backupDonation);
                sessionStorage.removeItem('hope_foundation_backup');
                $("body").trigger("update_checkout");
            }
        }
    });

    var $track = $('.carousel-track');
    var $slides = $track.find('.resource-container');
    var $nextBtn = $('.carousel-next');
    var $prevBtn = $('.carousel-prev');
    var currentIndex = 0;
    var totalSlides = $slides.length;

    function updateButtons() {
        var scrollLeft = $track.scrollLeft();
        var maxScroll = $track[0].scrollWidth - $track[0].clientWidth;
        
        // Disable/enable buttons based on scroll position
        if (scrollLeft <= 5) {
            $prevBtn.attr('disabled', true);
        } else {
            $prevBtn.removeAttr('disabled');
        }
        
        if (scrollLeft >= maxScroll - 5) {
            $nextBtn.attr('disabled', true);
        } else {
            $nextBtn.removeAttr('disabled');
        }
    }

    function scrollToSlide(index) {
        var slideWidth = $slides.eq(0).outerWidth(true); // includes margin/gap
        var targetScroll = index * slideWidth;
        
        $track.animate({
            scrollLeft: targetScroll
        }, 300);
    }

    function getVisibleSlides() {
        var trackWidth = $track.width();
        var slideWidth = $slides.eq(0).outerWidth(true);
        return trackWidth / slideWidth;
    }

    $nextBtn.on('click', function(e) {
        e.preventDefault();
        
        if (!$(this).is(':disabled')) {
            var visibleSlides = getVisibleSlides();
            var maxIndex = Math.ceil(totalSlides - visibleSlides);
            
            if (currentIndex < maxIndex) {
                currentIndex++;
                scrollToSlide(currentIndex);
            }
        }
    });

    $prevBtn.on('click', function(e) {
        e.preventDefault();
        
        if (!$(this).is(':disabled')) {
            if (currentIndex > 0) {
                currentIndex--;
                scrollToSlide(currentIndex);
            }
        }
    });

    // Update buttons on scroll
    $track.on('scroll', function() {
        updateButtons();
        
        // Update current index based on scroll position
        var slideWidth = $slides.eq(0).outerWidth(true);
        var scrollLeft = $track.scrollLeft();
        currentIndex = Math.round(scrollLeft / slideWidth);
    });

    // Handle window resize
    $(window).on('resize', function() {
        updateButtons();
    });

    // Initialize
    updateButtons();
})