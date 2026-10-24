<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    
    <section class="blogs-section life-story-abroad life-story-sec" style="padding: 0 0 0 0;">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12"><h1 style="font-size:32px;font-weight:700;line-height:41.6px;color:#1c1c1b;margin:0;text-align:center;text-transform:uppercase;"><?php single_cat_title(''); ?></h1></div>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="ast-col-md-4">
                        <div class="blog-item" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>'); margin-bottom: 50px;">
                            <div class="bolg-content">
                                <h3><?php the_title(); ?></h3>
                                <a class="blog-link" href="<?php the_permalink() ?>">READ MORE <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    
<?php endif; ?>

<?php astra_pagination(); ?>

<?php get_footer(); ?>