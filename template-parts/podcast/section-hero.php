<?php
    $hero_image = get_field('hero_image');
    if(is_array($hero_image)) {
        $hero_image = $hero_image['url'];
    }
?>

<section id="podcast-hero">
    <div class="podcast-hero-overlay">
        <img src="<?php echo esc_url($hero_image); ?>" alt="Tune in with TEFL Podcast" />
    </div>
</section>