<?php
/**
 * Affiliate sign-up and login (AffiliateWP).
 *
 * - Block editor on pages using the "Become an Affiliate" template, so the
 *   Affiliate Registration block form can be edited there (the rest of the
 *   site stays on the classic editor).
 * - Logged-in visitors on the affiliate login page go straight to the Affiliate Area.
 * - "Not an affiliate yet? Apply here" under the affiliate login forms.
 * - Sign-up tracking (GTM affiliate_signup + Meta CompleteRegistration) on the thank-you page.
 * - Creatives tab: grid view by default, newest-added first.
 * - Email to marketing@ when an affiliate requests a new coupon code name (Vanity Coupon Codes add-on).
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TI_AFFILIATE_AREA_PAGE', 1081);
define('TI_AFFILIATE_LOGIN_PAGE', 4279);
define('TI_AFFILIATE_SIGNUP_URL', '/become-a-tefl-affiliate/');
define('TI_AFFILIATE_THANK_YOU_SLUG', 'affiliate-thank-you');
define('TI_AFFILIATE_SIGNUP_TEMPLATES', array('page-affiliate.php', 'page-affiliate-v2.php'));

// Runs after functions.php's site-wide __return_false (priority 10).
add_filter('use_block_editor_for_post', function ($use, $post) {
    if ($post && 'page' === $post->post_type && in_array(get_page_template_slug($post), TI_AFFILIATE_SIGNUP_TEMPLATES, true)) {
        return true;
    }
    return $use;
}, 20, 2);

// The sign-up form has no Username field (the email is the username), but AffiliateWP still validates
// affwp_user_login, so fill it from the account email before AffiliateWP reads it.
add_action('affwp_pre_process_register_form', function () {
    if (is_user_logged_in() || !empty($_POST['affwp_user_login']) || empty($_POST['affwp_user_email'])) {
        return;
    }
    $email = sanitize_email(wp_unslash($_POST['affwp_user_email']));
    if (!is_email($email)) {
        return; // AffiliateWP reports the invalid email itself.
    }
    // Strict sanitising drops characters WordPress doesn't allow in usernames, such as "+".
    $base  = sanitize_user($email, true);
    $login = $base;
    for ($i = 2; username_exists($login); $i++) {
        $login = $base . '-' . $i;
    }
    $_POST['affwp_user_login'] = $login;
});

add_action('template_redirect', function () {
    if (is_page(TI_AFFILIATE_LOGIN_PAGE) && is_user_logged_in()) {
        wp_safe_redirect(get_permalink(TI_AFFILIATE_AREA_PAGE));
        exit;
    }

    // AffiliateWP opens the Creatives tab as a list unless ?view_type= or its cookie says otherwise.
    // Default to the image grid; the plugin then remembers the choice in its cookie.
    if (
        is_page(TI_AFFILIATE_AREA_PAGE)
        && isset($_GET['tab']) && 'creatives' === $_GET['tab']
        && !isset($_GET['view_type'])
        && empty($_COOKIE['affiliatewp_creatives_view_type'])
    ) {
        wp_safe_redirect(add_query_arg('view_type', 'grid'));
        exit;
    }
});

// Creatives tab: newest-added first unless the affiliate picks another sort order.
add_filter('affwp_affiliate_dashboard_creatives_args', function ($args) {
    if (!isset($_GET['orderby'])) {
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
    }
    return $args;
});

// Creatives grid as masonry: each card spans as many 4px grid rows as its banner needs, so mixed sizes
// (728x90 strips, 160x600 skyscrapers) pack tightly while keeping the newest-first, left-to-right order.
add_action('wp_footer', function () {
    if (!is_page(TI_AFFILIATE_AREA_PAGE)) {
        return;
    }
    ?>
    <script>
    (function () {
        var ROW = 4, GAP = 16;

        function layout(grid) {
            grid.querySelectorAll('.affwp-creative').forEach(function (card) {
                card.style.gridRowEnd = 'auto';
                card.style.gridRowEnd = 'span ' + Math.ceil((card.getBoundingClientRect().height + GAP) / ROW);
            });
        }

        function init() {
            var grid = document.querySelector('.affwp-creatives-view--as-grid');
            if (!grid) {
                return;
            }
            grid.classList.add('ti-masonry');

            var queued = false;
            function schedule() {
                if (queued) {
                    return;
                }
                queued = true;
                requestAnimationFrame(function () {
                    queued = false;
                    layout(grid);
                });
            }
            function watchImages() {
                grid.querySelectorAll('img').forEach(function (img) {
                    if (!img.complete) {
                        img.addEventListener('load', schedule, { once: true });
                    }
                });
            }

            watchImages();
            schedule();
            window.addEventListener('resize', schedule);
            // Infinite scroll appends more creatives.
            new MutationObserver(function () {
                watchImages();
                schedule();
            }).observe(grid, { childList: true });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
    </script>
    <?php
}, 100);

// Sign-up form "Preferred coupon code": file it as a normal code request on the affiliate's new dynamic coupon,
// so it waits in AffiliateWP > Vanity Coupon Codes for approval (and emails marketing@, below). The coupon is
// created just before affwp_register_user fires. The POST name comes from the field label "Preferred coupon code";
// if the label changes in the editor, update it here. Codes that are invalid or taken stay on the affiliate's record only.
add_action('affwp_register_user', function ($affiliate_id) {
    if (empty($_POST['affwp_preferred_coupon_code_text']) || !function_exists('affiliatewp_vanity_coupon_codes')) {
        return;
    }
    $db   = affiliatewp_vanity_coupon_codes()->db;
    $code = $db->sanitize_vanity_code(sanitize_text_field(wp_unslash($_POST['affwp_preferred_coupon_code_text'])));
    if ('' === $code || strlen($code) > 191 || !$db->is_unique($code, 'woocommerce')) {
        return;
    }
    $coupons = affwp_get_dynamic_affiliate_coupons($affiliate_id, false, false);
    $coupon  = $coupons ? reset($coupons) : null;
    if (!$coupon || $coupon->coupon_code === $code) {
        return;
    }
    $db->add(array(
        'affiliate_id' => $affiliate_id,
        'coupon_id'    => $coupon->coupon_id,
        'current_code' => $coupon->coupon_code,
        'vanity_code'  => $code,
        'integration'  => 'woocommerce',
        'type'         => 'dynamic',
    ));
}, 20);

// The Vanity Coupon Codes add-on emails affiliates when a request is approved or rejected, but tells nobody
// when one comes in. Email marketing@ once the request has been saved (the add-on has no after-insert hook).
add_action('affwp_pre_insert_vanity_coupon', function ($data) {
    add_action('shutdown', function () use ($data) {
        static $sent = false;
        if ($sent) {
            return;
        }
        $sent = true;

        global $wpdb;
        $saved = $wpdb->get_var($wpdb->prepare(
            "SELECT vanity_code_id FROM {$wpdb->prefix}affiliate_wp_vanity_coupon_codes WHERE affiliate_id = %d AND coupon_id = %d AND vanity_code = %s",
            $data['affiliate_id'],
            $data['coupon_id'],
            $data['vanity_code']
        ));
        if (!$saved) {
            return;
        }

        $affiliate_id = (int) $data['affiliate_id'];
        $email        = new Affiliate_WP_Emails();
        $email->__set('affiliate_id', $affiliate_id);

        $message  = "A new coupon code name has been requested.\n\n";
        $message .= 'Affiliate: ' . affwp_get_affiliate_name($affiliate_id) . ' (#' . $affiliate_id . ', ' . affwp_get_affiliate_email($affiliate_id) . ")\n";
        $message .= 'Current code: ' . $data['current_code'] . "\n";
        $message .= 'Requested code: ' . $data['vanity_code'] . "\n\n";
        $message .= 'Approve or reject it here: ' . set_url_scheme(admin_url('admin.php?page=affiliate-wp-vanity-coupon-codes'), 'https');

        $email->send('marketing@teflinstitute.com', 'Coupon code request: ' . $data['vanity_code'], $message);
    });
});

add_action('affwp_affiliate_login_form_bottom', function () {
    if (!is_page(array(TI_AFFILIATE_AREA_PAGE, TI_AFFILIATE_LOGIN_PAGE))) {
        return;
    }
    echo '<p class="ti-affwp-apply">Not an affiliate yet? <a href="' . esc_url(TI_AFFILIATE_SIGNUP_URL) . '">Apply here</a></p>';
});

// The Website URL field is type="url", so "mysite.com" fails browser validation and the form won't submit.
// Add https:// when it's missing, on blur and before the submit click validates the form.
add_action('wp_footer', function () {
    if (!is_page_template(TI_AFFILIATE_SIGNUP_TEMPLATES)) {
        return;
    }
    ?>
    <script>
    (function () {
        function fixUrl(input) {
            var v = input.value.trim();
            if (v && !/^[a-z][a-z0-9+.-]*:\/\//i.test(v)) {
                input.value = 'https://' + v.replace(/^\/+/, '');
            }
        }
        document.querySelectorAll('.affwp-register-form input[type="url"]').forEach(function (input) {
            input.addEventListener('blur', function () { fixUrl(input); });
            var form = input.form;
            form && form.querySelectorAll('[type="submit"]').forEach(function (btn) {
                btn.addEventListener('click', function () { fixUrl(input); }, true);
            });
        });
    })();
    </script>
    <?php
}, 100);

// Show/hide toggle on the password fields of the affiliate sign-up and login forms.
add_action('wp_footer', function () {
    if (!is_page_template(TI_AFFILIATE_SIGNUP_TEMPLATES) && !is_page(array(TI_AFFILIATE_AREA_PAGE, TI_AFFILIATE_LOGIN_PAGE))) {
        return;
    }
    ?>
    <style>
    .ti-pw-wrap { position: relative; display: block; }
    .ti-pw-wrap input { width: 100%; padding-right: 48px !important; }
    .ti-pw-toggle { position: absolute; top: 50%; right: 6px; transform: translateY(-50%); width: 36px; height: 36px; padding: 0; margin: 0; border: 0; border-radius: 8px; background: transparent; color: #55606a; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .ti-pw-toggle:hover, .ti-pw-toggle:focus-visible { color: #0f3042; background: rgba(15, 48, 66, .06); }
    .ti-pw-toggle svg { width: 20px; height: 20px; }
    .ti-pw-toggle .ti-pw-hide, .ti-pw-toggle[aria-pressed="true"] .ti-pw-show { display: none; }
    .ti-pw-toggle[aria-pressed="true"] .ti-pw-hide { display: block; }
    </style>
    <script>
    (function () {
        var eye = '<svg class="ti-pw-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>';
        var eyeOff = '<svg class="ti-pw-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 19c-6.5 0-10-7-10-7a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a18.5 18.5 0 0 1-2.16 3.19"/><path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/><line x1="2" y1="2" x2="22" y2="22"/></svg>';
        document.querySelectorAll('.affwp-form input[type="password"]').forEach(function (input) {
            var wrap = document.createElement('span');
            wrap.className = 'ti-pw-wrap';
            input.parentNode.insertBefore(wrap, input);
            wrap.appendChild(input);

            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'ti-pw-toggle';
            btn.setAttribute('aria-label', 'Show password');
            btn.setAttribute('aria-pressed', 'false');
            btn.innerHTML = eye + eyeOff;
            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
            wrap.appendChild(btn);
        });
    })();
    </script>
    <?php
}, 100);

add_action('wp_footer', function () {
    if (!is_page(TI_AFFILIATE_THANK_YOU_SLUG)) {
        return;
    }
    ?>
    <script>
    (function () {
        // Once per browser session, so a reload doesn't count a second sign-up.
        try {
            if (sessionStorage.getItem('ti_affiliate_signup')) return;
            sessionStorage.setItem('ti_affiliate_signup', '1');
        } catch (e) {}
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({ event: 'affiliate_signup' });
    })();
    </script>
    <?php // Separate script: Complianz holds anything mentioning the Meta pixel until marketing consent. ?>
    <script>
    (function () {
        try {
            if (sessionStorage.getItem('ti_affiliate_signup_meta')) return;
            sessionStorage.setItem('ti_affiliate_signup_meta', '1');
        } catch (e) {}
        if (typeof window.fbq === 'function') {
            window.fbq('track', 'CompleteRegistration', { content_name: 'Affiliate programme' });
        }
    })();
    </script>
    <?php
}, 100);
