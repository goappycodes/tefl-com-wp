<?php

/**
 * Template Name: Early Access Black Friday Sale Prz
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<style>

#content .ast-container {
    max-width: 100%;
    padding: 0 !important;
}

#primary {
    height: 50rem;
}

#content {
    background-image: url('https://tefl.ie/wp-content/uploads/2024/11/Screenshot-2024-11-12-at-09.15.58.png');
    background-repeat: no-repeat;
    background-size: cover;
}

.page-outer {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    height: -webkit-fill-available;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1111111;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: auto;
    padding: 15px;
}

.box-outer {
    background: #000;
    width: 800px;
    margin: auto;
    border-radius: 10px;
    border: 1px solid white;
    padding: 2rem;
    color: white;
    overflow: auto;
}

.box-outer img {
    height: 40px;
    width: auto;
    margin: auto;
    display: block;
}

.box-outer .title {
    font-size: 34px;
    line-height: 1.5;
    font-weight: 600;
    margin: 15px 0 0px;
    text-align: center;
}

.box-outer .title span {
    color: #EB2F43;
}

.box-outer .subtitle {
    font-size: 30px;
    text-align: center;
    margin-bottom: 10px;
}

.wpcf7 form>div {
    margin-bottom: 0rem;
}

.wpcf7 form>div {
    margin-bottom: 0rem;
}

.form p {
    margin-bottom: 1rem !important;
}

.join-txt p {
    display: flex;
    font-size: 14px;
    align-items: center;
}

.wpcf7 .wpcf7-form-control-wrap {
    width: auto;
}

.join-txt .wpcf7-form-control-wrap {
    margin: 5px;
}

label {
    display: block;
    margin-bottom: -20px;
}

.wpcf7-form-control.wpcf7-submit.has-spinner.btn.ptefl-button {
    background: #EB2F43;
    display: block;
    font-size: 18px;
    border-radius: 10px;
    font-weight: 600;
    height: 50px;
    width: 200px;
    margin: 10px auto -50px !important;
}

.intl-tel-input.allow-dropdown input {
    padding-left: 52px !important;
}

input, select {
    padding: 8px 12px !important;
}

</style>

<div id="primary" <?php astra_primary_class(); ?>>

    <div class="page-outer">

        <div class="box-outer">

            <img src="https://teflinstitute.com/wp-content/uploads/2024/11/site-logo-white.svg" class="logo">
            <div class="title"><span>VIP Early Access</span> our January Sales</div>
            <div class="subtitle">Includes 4 Free Gifts!</div>

            <div class="form"><?php echo do_shortcode('[contact-form-7 id="a146026" title="Early Access Black Friday Sale Prz"]'); ?></div>

        </div>

    </div>

</div>

<script>

document.addEventListener('wpcf7mailsent', function(event) {
    if (event.detail.contactFormId == '91266') {
        window.location.href = 'https://teflinstitute.com/tefl-january-sale/';
    }
}, false);
   
</script>

<?php get_footer(); ?>