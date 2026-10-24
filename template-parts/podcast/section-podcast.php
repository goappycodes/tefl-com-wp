<section id="podcast" class="ptb-60">
    <div class="ast-container">
        <div class="section-header">
            <h1 class="section-title">All Episodes - Tune in with TEFL</h1>
            <p class="section-subtitle entry-title">
                Listen to all Tune in with TEFL podcast episodes
            </p>
        </div>    
        
        <div class="podcast-container">
            <?php
                $podcasts = get_field('podcasts');
                if (!is_array($podcasts)) {
                    $podcasts = [];
                }
                
                $items_per_page = 3;
                $total_items = count($podcasts);
                $total_pages = ceil($total_items / $items_per_page);
                
                $current_page = isset($_GET['pg']) ? max(1, intval($_GET['pg'])) : 1;
                if ($total_pages > 0 && $current_page > $total_pages) {
                    $current_page = $total_pages;
                }
                
                $offset = ($current_page - 1) * $items_per_page;
                $paginated_podcasts = array_slice($podcasts, $offset, $items_per_page);
                
                foreach($paginated_podcasts as $podcast):
                    $thumnail           = $podcast['podcast_thumbnail'];
                    $podcast_heading    = $podcast['podcast_heading'];
                    $podcast_number     = $podcast['podcast_number'];
                    $podcast_short_note = $podcast['podcast_short_note'];
                    $spotify_embed      = $podcast['spotify_embed_link'];
                    $link               = $podcast['podcast_cta_link'];
            ?>
                <div class="podcast-card">
                    <div class="card-container">
                        <div class="card-image">
                            <img src="<?php echo $thumnail; ?>" alt="Podcast Episode 1">
                        </div>
                        <div class="card-content">
                            <h2 class="podcast-title"><?php echo $podcast_heading; ?></h2>
                            <div class="podcast-number">
                                <span><?php echo  $podcast_number; ?></span>
                            </div>
                            <div class="podcast-description">
                                <div><?php echo $podcast_short_note; ?></div>
                            </div>
                            <div class="podcast-player">
                                <div class="podcast-player">
                                <?php 
                                if ($spotify_embed) {
                                    $spotify_embed = trim($spotify_embed);
                                    
                                    // Extract URL from iframe if necessary
                                    if (preg_match('/src="([^"]+)"/i', $spotify_embed, $src_match)) {
                                        $spotify_embed = $src_match[1];
                                    }

                                    $type = 'episode';
                                    $episode_id = '';

                                    // Extract path from the URL
                                    $path = parse_url($spotify_embed, PHP_URL_PATH);
                                    if ($path) {
                                        $parts = explode('/', trim($path, '/'));
                                        $filtered = [];
                                        foreach ($parts as $part) {
                                            $part = trim($part);
                                            if (strtolower($part) !== 'embed' && $part !== '') {
                                                $filtered[] = $part;
                                            }
                                        }
                                        if (count($filtered) >= 2) {
                                            $episode_id = end($filtered);
                                            $type = $filtered[count($filtered) - 2];
                                        } elseif (count($filtered) === 1) {
                                            $episode_id = $filtered[0];
                                        }
                                    }

                                    // Fallback regex if path parsing failed to extract ID
                                    if (empty($episode_id)) {
                                        if (preg_match('/spotify\.com\/(?:embed\/)?(episode|track|playlist|show|embed-podcast)\/([a-zA-Z0-9]+)/i', $spotify_embed, $matches)) {
                                            $type = $matches[1];
                                            $episode_id = $matches[2];
                                        }
                                    }

                                    // Clean up ID
                                    if ($episode_id) {
                                        $episode_id = explode('?', $episode_id)[0];
                                        $episode_id = trim($episode_id);
                                    }
                                    
                                    if ($episode_id):
                                ?>
                                    <iframe 
                                        style="border-radius:12px; height: 80px !important; width: 100%;" 
                                        src="https://open.spotify.com/embed/<?php echo esc_attr($type); ?>/<?php echo esc_attr($episode_id); ?>?utm_source=generator" 
                                        width="100%" 
                                        height="80" 
                                        frameBorder="0" 
                                        allowfullscreen="" 
                                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                                        loading="lazy">
                                    </iframe>
                                <?php 
                                    endif;
                                } 
                                ?>
                            </div>
                            </div>
                            <a href="<?php echo esc_url($link); ?>" class="spotify-link-block" target="_blank" rel="noopener noreferrer">
                                <div class="podcast-links">
                                    <div class="spotify-logo-container">
                                        <img src="/wp-content/uploads/2026/06/spotify-logo.png" alt="Spotify logo" class="spotify-logo-img">
                                    </div>
                                    <div class="spotify-text-container">
                                        <span class="spotify-listen-text">Listen on</span>
                                        <img src="/wp-content/uploads/2026/06/spotify-name.png" alt="Spotify" class="spotify-name-img">
                                    </div>
                                </div>  
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($total_pages > 1): ?>
            <div class="podcast-pagination">
                <?php

                if ($current_page > 1):
                    $prev_url = esc_url(add_query_arg('pg', $current_page - 1) . '#podcast');
                    echo '<a href="' . $prev_url . '" class="podcast-page-btn prev-btn">&laquo; Prev</a>';
                else:
                    echo '<span class="podcast-page-btn prev-btn disabled">&laquo; Prev</span>';
                endif;
                $range = 1;
                $pages_to_show = [];
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == 1 || $i == $total_pages || ($i >= $current_page - $range && $i <= $current_page + $range)) {
                        $pages_to_show[] = $i;
                    }
                }

                $prev_val = 0;
                foreach ($pages_to_show as $page_num) {
                    if ($prev_val > 0 && $page_num - $prev_val > 1) {
                        echo '<span class="podcast-page-dots">...</span>';
                    }
                    
                    if ($page_num == $current_page) {
                        echo '<span class="podcast-page-btn active">' . $page_num . '</span>';
                    } else {
                        $page_url = esc_url(add_query_arg('pg', $page_num) . '#podcast');
                        echo '<a href="' . $page_url . '" class="podcast-page-btn">' . $page_num . '</a>';
                    }
                    $prev_val = $page_num;
                }

                // Next button
                if ($current_page < $total_pages):
                    $next_url = esc_url(add_query_arg('pg', $current_page + 1) . '#podcast');
                    echo '<a href="' . $next_url . '" class="podcast-page-btn next-btn">Next &raquo;</a>';
                else:
                    echo '<span class="podcast-page-btn next-btn disabled">Next &raquo;</span>';
                endif;
                ?>
            </div>
        <?php endif; ?>
        <?php 
            $host_details = get_field('host_details');
            if($host_details){
                $host_1_image = $host_details['host_1_image'];
                $host_1_name  = $host_details['host_1_name'];
                $host_2_image = $host_details['host_2_image'];
                $host_2_name  = $host_details['host_2_name'];
                $heading      = $host_details['heading'];
                $content      = $host_details['content'];
            } 
        ?>
        <div class="podcast-host-container">
            <div class="podcast-host-images">
                <div class="host-image">
                    <img src="<?php echo $host_1_image; ?>" alt="">
                    <p><?php echo $host_1_name; ?></p>
                </div>
                <div class="host-image">
                    <img src="<?php echo $host_2_image; ?>" alt="">
                    <p><?php echo $host_2_name; ?></p>
                </div>
            </div>
            <div class="podcast-host-content">
                <h2 class="section-title"><?php echo $heading; ?></h2>
                <div class="entry-content">
                    <?php  echo $content; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        $cta_heading = get_field('cta_heading');
    ?>
    <div class="podcast-listen-banner">
        <div class="banner-inner">
            <?php if($cta_heading): ?>
                <h3 class="banner-title"><?php echo $cta_heading; ?></h3>
            <?php endif;?>
            <div class="banner-buttons">
                <?php 
                    $cta_button =  get_field('cta_button');
                    foreach($cta_button as $cta_btn):
                        $cta_icon =  $cta_btn['cta_icon'];
                        $cta_text = $cta_btn['cta_text'];
                        $cta_link = $cta_btn['cta_link'];
                ?>
                <a href="<?php echo $cta_link; ?>" class="banner-btn">
                    <img src="<?php echo $cta_icon; ?>" alt="">
                    <span><?php echo $cta_text; ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>