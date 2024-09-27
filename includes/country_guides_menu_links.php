<?php
    $args = array(
		'post_type'			=> 'teach_english_abroad',
		'posts_per_page'	=>  24, 
		'post_status'       => 'publish',
        'meta_key'          => 'country_name',
        'orderby'		    => 'meta_value',
        'order'             => 'ASC'
	);

	$the_query = new WP_Query($args);
?>
<div class="country-guide-links">
    <?php if($the_query->have_posts()): ?>		
        <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="ast-col-md-3 country-guide">
                <a href="<?php the_permalink()?>" class="guide-link"><img src="/wp-content/uploads/2022/10/Guide-icon.png" alt="guide-icon" class="guide-icon"> <?php the_field('country_name');?></a>
            </div>
        <?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
    <div style="display:none" class="ast-col-md-12 mt-2">
        <?php foreach($left_cta_buttons as $cta_button):
            $btn_image = $cta_button['button_imageicon'];
            $btn_text  = $cta_button['button_text'];
            $btn_link  = $cta_button['button_link'];  
            $btn_bg_color = $cta_button['button_background_color'];
            $btn_text_color = $cta_button['button_text_color'];
            $btn_text_font_size = $cta_button['button_text_size']; 
        ?>
            <a style="color:<?php echo $btn_text_color.' !important'?>; font-size:<?php echo $btn_text_font_size?>px; background:<?php echo $btn_bg_color?>" href="<?php echo $btn_link?>" href="<?php echo $btn_link?>" class="cta-link">
                <img src="<?php echo $btn_image?>" alt="" class="btn-img"/>
                <span class="btn-text"><?php echo $btn_text?></span>
            </a>
        <?php endforeach?>
    </div>
</div>