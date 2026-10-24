<?php
?>
<style>
    .save-search-modal {
        display: none;
        position: fixed;
        z-index: 9999999999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .save-search-modal .modal-content {
        background-color: #0c0c0c;
        padding: 2rem 3rem;
        width: 50%;
        z-index: 9999999;
        margin: 5% auto;
        border-radius: 10px;
    }

    .modal-content__header img.modal-site-logo {
        width: 200px;
    }

    .modal-content__header img.modal-gif {
        margin: 1.5rem auto;
        width: 300px;
        display: block;
        filter:invert(1);
        border-radius:2rem;
    }

    h3.modal-content__header-title {
        color: var(--white);
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .modal-contact-form  .wpcf7-response-output{
        color:var(--red);
        border-color:var(--red);
    }
    .modal-contact-form .wpcf7 form.sent .wpcf7-response-output{
        color:#46b450;
        border-color:#46b450;
    }
    .modal-contact-form input[type="email"] {
        width: 75%;
        text-align: center;
        border: none;
        color: var(--black-jet);
        font-weight: 500;
        margin-bottom:1rem;
    }

    .modal-contact-form input[type="email"]:placeholder{
        color:var(--black-jet);
    }

    .modal-contact-form input[type="email"]:focus {
        border: none;
    }
    .modal-contact-form form br {
        display: none;
    }

    .modal-contact-form span.wpcf7-form-control.wpcf7-acceptance {
        color: #fff;
    }

    .modal-contact-form input[type="submit"] {
        background: var(--white) !important;
        border-radius: 4px !important;
        line-height: 1;
        font-weight: 700;
        width: max-content;
        margin: 1rem auto 0 !important;
        padding: 10px 20px!important;
        color: var(--black);
        line-height: 1;
        /* border-radius: 4px; */
    }

    .modal-contact-form .wpcf7-spinner {
        /* position: absolute; */
        display:initial;
    }

    .save-search-modal .close-btn {
        all: unset;
        text-decoration: underline;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        color: var(--red);
    }
    
    .mobile-save-search-btn {
        display: none;
    }

    @media screen and (max-width: 768px) {
        .mobile-save-search-btn {
            display: block;
            position: fixed;
            bottom: 145px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--red);
            color: white;
            padding: 10px 16px;
            border-radius: 30px;
            z-index: 999999999;
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            font-size: 12px;
        }

        .mobile-save-search-btn.hidden {
            display: none;
        }
        .save-search-modal .modal-content {
            width: 90%;
            padding: 1rem;
        }
    }
</style>
<div class="save-search-modal">
    <div class="modal-content text-center">
        <div class="modal-content__header">
            <?php 
                $custom_logo_id = get_theme_mod('custom_logo'); 
                $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full'); 
                $logo_url = $logo_url ? esc_url($logo_url) : ''; 
            ?>
            <img class="modal-site-logo" src="<?php echo $logo_url; ?>" alt="Site Logo">
            <img class="modal-gif" src="/wp-content/uploads/2024/10/save-your-search.gif" alt="">
            <h3 class="modal-content__header-title">
            Send this search result to your email and come back to view later
            </h3>
        </div>
        <div class="modal-contact-form">
            <?php echo do_shortcode('[contact-form-7 id="08387c0" title="Save Your Search"]')?>
        </div>
        <a href="#" class="close close-btn">No Thanks</a>
    </div>
</div>
<a href="#" class="mobile-save-search-btn">Save Your Search</a>
<script>
    jQuery('document').ready(function ($) {
        let saveSearchModal = $(".save-search-modal");
        let closeButton = $(".save-search-modal .close-btn");
        let mobileSaveSearchBtn = $(".mobile-save-search-btn");
        
        mobileSaveSearchBtn.click(function(e) {
            e.preventDefault();
            saveSearchModal.fadeIn(500);
        });

        const mouseEvent = function (e) {
            const shouldShowExitIntent =
                !e.toElement && !e.relatedTarget && e.clientY < 5;

            if (shouldShowExitIntent) {
                $(document).off('mouseout', mouseEvent);
                saveSearchModal.fadeIn(500);
                CookieService.setCookie('exitIntent', true, 7,'/');
            }
        };

        if (!CookieService.getCookie('exitIntent')) {
            console.log('Exit intent listener added');
     
            setTimeout(function () {
                $(document).on('mouseout', mouseEvent);
            }, 3000);
        }

        closeButton.click(function(e) {
            e.preventDefault();
            saveSearchModal.fadeOut(500);
        });

        $(window).click(function(event) {
            if (event.target == saveSearchModal[0]) {
                saveSearchModal.fadeOut(500);
            }
        });

        $(document).on('wpcf7mailsent', function (event) {
            if (event.detail.contactFormId == '90020') {
                setTimeout(function() {

                    saveSearchModal.fadeOut(500);
                    
                    mobileSaveSearchBtn.addClass('hidden');
                    
                    // CookieService.setCookie('searchSaved', true, 30, '/');
                }, 3000); 
            }
        });

        // if (CookieService.getCookie('searchSaved')) {
        //     mobileSaveSearchBtn.addClass('hidden');
        // }
    });
</script>
