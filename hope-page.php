<?php

/**
 * Template Name: Hope Foundation Page Template
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Przemysław Solan <przemek.solan@tefl.ie>
 * @date 130th June 2025
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area primary">

<!-- Banner Section -->

<?php
$banner = get_field('banner');
$banner_background_image = $banner['banner_background_image'];
$banner_title            = $banner['banner_title'];
$banner_logo             = $banner['banner_logo'];
if ($banner) {
?>
<section class="hope-banner" style="background-image: url('<?php echo $banner_background_image; ?>')">
  <div class="banner-overlay"></div>
  <div class="banner-inner">
    <div class="banner-text">
      <h2><?php echo $banner_title; ?></h2>
    </div>
    <div class="banner-logo">
      <img src="<?php echo $banner_logo; ?>" alt="The Hope Foundation Logo">
    </div>
  </div>
</section>
<?php } ?>

<!-- Hope Partnerhip Section -->

<?php
$hope_partnership = get_field('hope_partnership');
$partner_title    = $hope_partnership['partner_title'];
$description      = $hope_partnership['description'];
$button_text      = $hope_partnership['button_text'];
$button_link      = $hope_partnership['button_link'];
if ($hope_partnership) {
?>
<section class="hope-partnership">
  <div class="container">
    <div class="left-content">
      <h2><?php echo $partner_title; ?></h2>
    </div>
    <div class="right-content">
      <?php echo $description; ?>
      <a href="<?php echo $button_link; ?>" class="read-more d-none" target="_blank" rel="noopener noreferrer"><?php echo $button_text; ?> <span>▼</span></a>
    </div>
  </div>
</section>
<?php } ?>

<!-- Logo Section -->

<?php
$logo_section = get_field('logo_section');
$hope_logo    = $logo_section['hope_logo'];
$cross_logo   = $logo_section['cross_logo'];
$tefl_logo    = $logo_section['tefl_logo'];
if ($logo_section) {
?>
<section class="logo-section">
  <div class="ast-container">
    <div class="logos-container">
      <div class="logo hope-logo">
        <img src="<?php echo $hope_logo; ?>" alt="The Hope Foundation Logo" >
      </div>
      <div class="logo cross-logo">
        <img src="<?php echo $cross_logo; ?>" >
      </div>
      <div class="logo tefl-logo">
        <img src="<?php echo $tefl_logo; ?>" alt="tefl-logo" >
      </div>
    </div>
  </div>
</section>
<?php } ?>

<!-- Mission Section -->

<?php
$mission_section = get_field('mission_section');
$mission_card    = $mission_section['mission_card'];
if ($mission_card) {
?>
<section class="mission-section">
  <div class="ast-container">
    <div class="mission-container">
      <?php foreach($mission_card as $card) :
        $card_title       = $card['card_title'];
        $card_description = $card['card_description'];
        $card_image       = $card['card_image'];
      ?>
      <div class="card">
          <h3 class="section-title double-underline"><?php echo $card_title; ?></h3>
          <p><?php echo $card_description; ?></p>
          <img src="<?php echo $card_image; ?>" >
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php } ?>

<!-- Vision Section -->

<?php
$vision_section = get_field('vision_section');
$vision_title    = $vision_section['vision_title'];
$description    = $vision_section['description'];
if ($vision_section) {
?>
<section class="vision-section">
  <div class="ast-container">
    <div class="content-container">
      <h3 class="section-title double-underline"><?php echo $vision_title; ?></h3>
      <p><?php echo $description; ?></p>
    </div>
  </div>
</section>
<?php } ?>

<!-- Education Section -->

<?php
$education_section = get_field('education_section');
$section_title          = $education_section['section_title'];
$section_image          = $education_section['section_image'];
$section_description    = $education_section['section_description'];
if ($education_section) {
?>
<section class="education-section">
  <div class="ast-container">
    <h3 class="section-title double-underline"><?php echo $section_title; ?></h3>
    <div class="education-content">
      <img src="<?php echo $section_image; ?>" >
      <div class="text-content">
        <?php echo $section_description; ?>
      </div>
    </div>
  </div>
</section>
<?php } ?>

<!-- Help Section -->

<?php
$help_section = get_field('help_section');
$section_title          = $help_section['section_title'];
$top_paragraph          = $help_section['top_paragraph'];
$section_images    = $help_section['section_images'];
$bottom_paragraph    = $help_section['bottom_paragraph'];
if ($help_section) {
?>
<section class="help-section">
  <div class="ast-container">
    <div class="content-container">
      <h3 class="section-title double-underline"><?php echo $section_title; ?></h3>
      <p><?php echo $top_paragraph; ?></p>
      <div class="image-box">
        <?php foreach($section_images as $images) :
          $image = $images['image'];
        ?>
        <img src="<?php echo $image; ?>" >
        <?php endforeach; ?>
      </div>
      <p><?php echo $bottom_paragraph; ?></p>
    </div>
  </div>
</section>
<?php } ?>

<!-- Donate Section -->

<?php
$donate_section = get_field('donate_section');
$section_text   = $donate_section['section_text'];
$button_link    = $donate_section['button_link'];
$button_text    = $donate_section['button_text'];
$button_icon    = $donate_section['button_icon'];
if ($donate_section) {
?>
<section class="donate-section">
  <div class="ast-container">
    <div class="content-container">
      <p><?php echo $section_text; ?></p>
      <a href="<?php echo $button_link; ?>" class="donate-btn">
        <img src="<?php echo $button_icon; ?>" alt="Heart" class="heart-icon">
        <?php echo $button_text; ?>
    </a>
    </div>
  </div>
</section>
<?php } ?>

</div>
<?php get_footer(); ?>