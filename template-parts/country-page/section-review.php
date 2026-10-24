 <?php
        $reviews       = get_field('reviews');
  ?>
    <?php if($reviews): ?>
        <section id="tefl_reviews" class="reviews ptb-50 secondary-bg">
        <div class="ast-container">
            <div class="section-inner">
                <div class="tefl-slider-wrapper width-md">
                    <div class="tefl-slider-review">
                        <?php foreach($reviews as $review):
                            $client_photo 		= $review['client_image'];
                            $client_name 		= $review['client_name'];
                            $client_designation = $review['client_designation'];
                            $reviews			= $review['review'];
                            if($client_name && $reviews): ?>
                                <div class="tefl-review">
                                    <div class="client-review">
                                        <?php if($client_photo): ?>
                                            <div class="client-photo">    
                                                <img src="<?php echo $client_photo; ?>" alt="<?php echo $client_name; ?>" class="client-img">
                                            </div>
                                        <?php endif; ?>
                                        <div class="client-info review-content">
                                            <div class="reviewer-info">
                                                <h3 class="reviewer-name font-bold m-0"><?php echo $client_name; ?></h3>
                                                - <h6 class="client-designation font-regular m-0"><?php echo $client_designation; ?></h6>
                                            </div>
                                            <div class="client-rating">
                                                <?php
                                                    for($i = 0; $i < 5; $i++){
                                                ?>
                                                    <img src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/star.svg" alt="Star" class="star-icon">
                                                <?php
                                                    } 
                                                ?>

                                                <div class="review-days">
                                                    <span class="font-regular">16 days ago</span>
                                                </div>
                                            </div>
                                            <div class="client-review"><?php echo $reviews; ?></div>
                                        </div>
                                    </div>
                                </div><?php
                            endif;
                        endforeach; ?> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>