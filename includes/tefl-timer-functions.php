<?php

add_shortcode('tefl_timer_shortcode', 'tefl_timer_shortcode_fn');

function tefl_timer_shortcode_fn($attr)
{

    wp_enqueue_style('ti-timer-css');
    wp_enqueue_script('ti-timer-js');

    $args = shortcode_atts(array(
        'timer' => 'global'
    ), $attr);

    if ($args['timer'] == 'sale') {
        $timer_section = get_field('timer_section', 56529);
        $timer_expiry  = get_field('timer_expiry', 'option');
    } 
    else if($args['timer']==='black-friday-sales'){
        $timer_expiry = get_field('black_friday_sale_timer_expiry', 'option');
    }
    else {
        $timer_expiry = get_field('timer_expiry', 'option');
        // $expiry_date = get_field('expiry_date', 'option');
    }
	
    $now_ts = strtotime("now");
    $timer_exp_ts = strtotime($timer_expiry);
    $course_offer_end_date = date("l jS F", $timer_exp_ts);



        echo '<p class="offer-ends">Offer Ends ' . $course_offer_end_date . '</p>';

        if (is_singular('paid_internship')) :
            echo '<p class="time-left-txt">Time Left To Save</p>';
        endif;

        if($timer_exp_ts > $now_ts):
            ob_start(); ?>
                <div class="<?php echo $now_ts.'--'.$timer_exp_ts?> tefl_countdown_timer_new">
                    <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $timer_expiry ?>">
                    
                    <!-- TIMER -->
        
                    <div class="clock">
                        <div class="clock-day">
                            <div class="clock-inner">
                                <div class="digit tenday">
                                    <span class="base"></span>
                                </div>
                                <div class="digit day">
                                    <span class="base"></span>
                                </div>
                            </div>
                            <span class="digit-text">Days</span>
                        </div>
                        <div class="clock-hour">
                            <div class="clock-inner">
                                <div class="digit tenhour">
                                    <span class="base"></span>
                                </div>
                                <div class="digit hour">
                                    <span class="base"></span>
                                </div>
                            </div>
                            <span class="digit-text">Hours</span>
                        </div>
                        <div class="clock-min">
                            <div class="clock-inner">
                                <div class="digit tenmin">
                                    <span class="base"></span>
                                </div>
                                <div class="digit min">
                                    <span class="base"></span>
                                </div>
                            </div>
                            <span class="digit-text">Minutes</span>
                        </div>
                        <div class="clock-sec">
                            <div class="clock-inner">
                                <div class="digit tensec">
                                    <span class="base"></span>
                                </div>
                                <div class="digit sec">
                                    <span class="base"></span>
                                </div>
                            </div>
                            <span class="digit-text">Seconds</span>
                        </div>
                    </div>
                    <!-- /TIMER -->
                </div>
            <?php 
         
            elseif($timer_exp_ts < $now_ts):
               
            ?>
            <div class=" tefl_countdown_timer_new">
                    <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $timer_expiry ?>">
                    
                    <!-- TIMER -->
        
                    <div class="clock">
                        <div class="clock-day">
                            <div class="clock-inner">
                                <div class="digit tenday">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit day">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Days</span>
                        </div>
                        <div class="clock-hour">
                            <div class="clock-inner">
                                <div class="digit tenhour">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit hour">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Hours</span>
                        </div>
                        <div class="clock-min">
                            <div class="clock-inner">
                                <div class="digit tenmin">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit min">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Minutes</span>
                        </div>
                        <div class="clock-sec">
                            <div class="clock-inner">
                                <div class="digit tensec">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit sec">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Seconds</span>
                        </div>
                    </div>
                    <!-- /TIMER -->
                </div>
            <?php endif; 
       
    return ob_get_clean();
}

add_shortcode('tefl_timer_shortcode_new', 'tefl_timer_shortcode_new_fn');

function tefl_timer_shortcode_new_fn($attr)
{

    wp_enqueue_style('ti-timer-css');
    wp_enqueue_script('ti-timer-js');

    // $args = shortcode_atts(array(
    //     'timer' => 'global'
    // ), $attr);

    if ($args['timer'] == 'sale') {
        $timer_section = get_field('timer_section', 56529);
        $timer_expiry = get_field('timer_expiry', 'option');
    } 
    else if($args['timer']==='black-friday-sales'){
        $timer_expiry = get_field('black_friday_sale_timer_expiry', 'option');
    }
    else if($args['timer']==='course_overview'){
        $timer_section = get_field('offer_section',79087);
        $timer_expiry = $timer_section['offer_expiry_date'];
        if(empty($timer_expiry)){
            $timer_expiry = get_field('timer_expiry', 'option');
        }
    }
    else {
        $timer_expiry = get_field('timer_expiry', 'option');
        // $expiry_date = get_field('expiry_date', 'option');
    }
	
    $now_ts = strtotime("now");
    $timer_exp_ts = strtotime($timer_expiry);
    $course_offer_end_date = date("l jS F", $timer_exp_ts);

        if($timer_exp_ts > $now_ts):
            ob_start(); ?>
                <div class="<?php echo $now_ts.'--'.$timer_exp_ts?> tefl_countdown_timer_new">
                    <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $timer_expiry ?>">
                    
                    <!-- TIMER -->
                    <div class="offer-ends">
                        <span>Offer Ends</span>
                        <?php echo $course_offer_end_date?>
                    </div>
                    <div class="clock">
                        <div class="clock-day">
                            <div class="clock-inner">
                                <div class="digit tenday">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit day">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Days</span>
                        </div>
                        <div class="clock-hour">
                            <div class="clock-inner">
                                <div class="digit tenhour">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit hour">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Hours</span>
                        </div>
                        <div class="clock-min">
                            <div class="clock-inner">
                                <div class="digit tenmin">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit min">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Minutes</span>
                        </div>
                        <div class="clock-sec">
                            <div class="clock-inner">
                                <div class="digit tensec">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit sec">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Seconds</span>
                        </div>
                    </div>
        
                    <!-- /TIMER -->
                </div>
            <?php 
            elseif($timer_exp_ts < $now_ts):
            ?>
            <div class=" tefl_countdown_timer_new">
                    <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $timer_expiry ?>">
                    
                    <!-- TIMER -->
        
                    <div class="clock">
                        <div class="clock-day">
                            <div class="clock-inner">
                                <div class="digit tenday">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit day">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Days</span>
                        </div>
                        <div class="clock-hour">
                            <div class="clock-inner">
                                <div class="digit tenhour">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit hour">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Hours</span>
                        </div>
                        <div class="clock-min">
                            <div class="clock-inner">
                                <div class="digit tenmin">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit min">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Minutes</span>
                        </div>
                        <div class="clock-sec">
                            <div class="clock-inner">
                                <div class="digit tensec">
                                    <span class="base">0</span>
                                </div>
                                <div class="digit sec">
                                    <span class="base">0</span>
                                </div>
                            </div>
                            <span class="digit-text">Seconds</span>
                        </div>
                    </div>
        
                    <!-- /TIMER -->
                </div>
            <?php endif; 
    return ob_get_clean();
}


// Redesigned Clock


function flip_countdown_timer_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'expiry_date' => '', 
        ), 
        $atts
    );
    $expiry_date = !empty($atts['expiry_date']) ? $atts['expiry_date'] : get_field('timer_expiry', 'option');
    $unique_id = uniqid('countdown-timer-');

    ob_start();
    ?>
    <div id="<?php echo esc_attr($unique_id); ?>" class="countdown-timer"></div>
    
    <script async>
    (function($) {
        var deadline = new Date(Date.parse("<?php echo esc_js($expiry_date); ?>"));
        
        function CountdownTracker(label, value) {
            var el = $('<span class="flip-clock__piece"><b class="flip-clock__card card"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b><span class="flip-clock__slot">' + label + '</span></span>');
            this.el = el;
            var top = el.find('.card__top'),
                bottom = el.find('.card__bottom'),
                back = el.find('.card__back'),
                backBottom = el.find('.card__back .card__bottom');
            this.update = function(val) {
                val = ('0' + val).slice(-2);
                if (val !== this.currentValue) {
                    if (this.currentValue >= 0) {
                        back.attr('data-value', this.currentValue);
                        bottom.attr('data-value', this.currentValue);
                    }
                    this.currentValue = val;
                    top.text(this.currentValue);
                    backBottom.attr('data-value', this.currentValue);
                    this.el.removeClass('flip');
                    void this.el[0].offsetWidth;
                    this.el.addClass('flip');
                }
            }
            this.update(value);
        }

        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            return {
                'Total': t,
                'Days': Math.floor(t / (1000 * 60 * 60 * 24)),
                'Hours': Math.floor((t / (1000 * 60 * 60)) % 24),
                'Minutes': Math.floor((t / (1000 * 60)) % 60),
                'Seconds': Math.floor((t / 1000) % 60)
            };
        }

        function Clock(countdown, callback) {
            countdown = countdown ? new Date(Date.parse(countdown)) : false;
            callback = callback || function() {};
            var updateFn = countdown ? getTimeRemaining : getTime;
            this.el = $('<div class="flip-clock"></div>');
            var trackers = {
                'Days': new CountdownTracker('Days', 0),
                'Hours': new CountdownTracker('Hours', 0),
                'Minutes': new CountdownTracker('Minutes', 0),
                'Seconds': new CountdownTracker('Seconds', 0)
            };
            for (var key in trackers) {
                this.el.append(trackers[key].el);
            }
            function updateClock() {
                timeinterval = requestAnimationFrame(updateClock);
                var t = updateFn(countdown);
                if (t.Total < 0) {
                    cancelAnimationFrame(timeinterval);
                    for (var key in trackers) {
                        trackers[key].update(0);
                    }
                    return;
                }
                for (var key in trackers) {
                    trackers[key].update(t[key]);
                }
            }
            updateClock();
        }

        var c = new Clock(deadline);
        $('#<?php echo esc_js($unique_id); ?>').append(c.el);
    })(jQuery);
    </script>


    <style>
    
    .flip-clock__piece {
        display: inline-block;
        margin: 0 5px;
    }
    .flip-clock__slot {
        font-size: 10px;
        text-align: center;
        display: block;
        color:var(--white);
    }
    .card {
        display: block;
        position: relative; 
        padding-bottom: 0.72em;
        font-size: 1.5rem;
        line-height: 0.95;
        text-align:center;
    }
    .card__top, .card__bottom, .card__back::before, .card__back::after {
        display: block;
        height: 17px;
        color: var(--black-jet);
        background: var(--white);
        padding: 0.25em 0.25em;
        border-radius: 0.15em 0.15em 0 0;
        backface-visiblity: hidden;
        transform-style: preserve-3d;
        width: 40px;
        transform: translateZ(0);
    }
    .card__bottom {
        color: var(--black-jet);
        position: absolute;
        top: 50%;
        left: 0;
        /* border-top: solid 1px #000; */
        background: #e5e5e5 !important;
        border-radius: 0 0 0.15em 0.15em;
        pointer-events: none;
        overflow: hidden;
    }
    .card__bottom::after {
        display: block;
        margin-top: -0.72em;
    }
    .card__back::before,
    .card__bottom::after {
        content: attr(data-value);
    }
    .card__back {
        position: absolute;
        top: 0;
        height: 100%;
        left: 0%;
        pointer-events: none;
    }
    .card__back::before {
        position: relative;
        z-index: -1;
        overflow: hidden;
    }
    .flip .card__back::before {
        animation: flipTop 0.3s cubic-bezier(.37,.01,.94,.35);
        animation-fill-mode: both;
        transform-origin: center bottom;
    }
    .flip .card__back .card__bottom {
        transform-origin: center top;
        animation-fill-mode: both;
        animation: flipBottom 0.6s cubic-bezier(.15,.45,.28,1);
    }
    @keyframes flipTop {
        0% {
            transform: rotateX(0deg);
            z-index: 2;
        }
        0%, 99% {
            opacity: 0.99;
        }
        100% {
            transform: rotateX(-90deg);
            opacity: 0;
        }
    }
    @keyframes flipBottom {
        0%, 50% {
            z-index: -1;
            transform: rotateX(90deg);
            opacity: 0;
        }
        51% {
            opacity: 0.99;
        }
        100% {
            opacity: 0.99;
            transform: rotateX(0deg);
            z-index: 5;
        }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('flip_countdown_timer', 'flip_countdown_timer_shortcode');
