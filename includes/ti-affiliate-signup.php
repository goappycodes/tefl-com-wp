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
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TI_AFFILIATE_AREA_PAGE', 1081);
define('TI_AFFILIATE_LOGIN_PAGE', 4279);
define('TI_AFFILIATE_SIGNUP_URL', '/become-a-tefl-affiliate/');
define('TI_AFFILIATE_THANK_YOU_SLUG', 'affiliate-thank-you');

// Runs after functions.php's site-wide __return_false (priority 10).
add_filter('use_block_editor_for_post', function ($use, $post) {
    if ($post && 'page' === $post->post_type && 'page-affiliate.php' === get_page_template_slug($post)) {
        return true;
    }
    return $use;
}, 20, 2);

add_action('template_redirect', function () {
    if (is_page(TI_AFFILIATE_LOGIN_PAGE) && is_user_logged_in()) {
        wp_safe_redirect(get_permalink(TI_AFFILIATE_AREA_PAGE));
        exit;
    }
});

add_action('affwp_affiliate_login_form_bottom', function () {
    if (!is_page(array(TI_AFFILIATE_AREA_PAGE, TI_AFFILIATE_LOGIN_PAGE))) {
        return;
    }
    echo '<p class="ti-affwp-apply">Not an affiliate yet? <a href="' . esc_url(TI_AFFILIATE_SIGNUP_URL) . '">Apply here</a></p>';
});

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
