<?php
/**
 * Template Name: Partners
 */

get_header();

$hero_title                 = get_field('partners_hero_title') ?: get_the_title();
$hero_text                  = get_field('partners_hero_text');
$hero_primary_button_text   = get_field('partners_hero_primary_button_text');
$hero_primary_button_url    = get_field('partners_hero_primary_button_url');
$hero_secondary_button_text = get_field('partners_hero_secondary_button_text');
$hero_secondary_button_url  = get_field('partners_hero_secondary_button_url');

$hero_form_title            = get_field('partners_hero_form_title');
$hero_form_note             = get_field('partners_hero_form_note');
$hero_stats                 = get_field('partners_hero_stats');

$logos_title                = get_field('partners_logos_title');

$features_title             = get_field('partners_features_title');

$steps_title                = get_field('partners_steps_title');

$revenue_title              = get_field('partners_revenue_title');

$case_studies_title         = get_field('partners_case_studies_title');

$support_title              = get_field('partners_support_title');
$support_text               = get_field('partners_support_text');
$support_form_title         = get_field('partners_support_form_title');
$support_form_text          = get_field('partners_support_form_text');

$bottom_cta_title           = get_field('partners_bottom_cta_title');
$bottom_cta_text            = get_field('partners_bottom_cta_text');
$bottom_cta_button_text     = get_field('partners_bottom_cta_button_text');
$bottom_cta_button_url      = get_field('partners_bottom_cta_button_url');

$img_tesol_logo_2 = '/wp-content/uploads/2026/07/TESOL-LOGO-2.jpg';   
$img_tesol_logo_1 = '/wp-content/uploads/2026/07/TESOL-LOGO-1-.jpg';  
$img_handshake    = '/wp-content/uploads/2026/07/ChatGPT-Image-Jul-16-2026-11_24_54-AM.png'; 

add_filter('wpcf7_autop_or_not', function ($enabled) {
    $form = WPCF7_ContactForm::get_current();
    if ($form && $form->title() === 'Country Report Form') {
        return false;
    }
    return $enabled;
});

?>

<main id="primary" class="site-main partners-page">

    <section id="hero" class="partners-hero">
        <div class="partners-container">
            <div class="partners-hero__grid">

                <div class="partners-hero__content">
                    <?php if ($hero_title) : ?>
                        <h1 class="partners-hero__title"><?php echo esc_html($hero_title); ?></h1>
                    <?php endif; ?>

                    <?php if ($hero_text) : ?>
                        <div class="partners-hero__text">
                            <?php echo wp_kses_post(wpautop($hero_text)); ?>
                        </div>
                    <?php endif; ?>

                    <div class="partners-hero__buttons">
                        <?php if ($hero_primary_button_text) : ?>
                            <a class="partners-btn partners-btn--dark js-dlopo-book-call" href="https://dlopo.com/chloe-joomun/intro-call">
                                <?php echo esc_html($hero_primary_button_text); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($hero_secondary_button_text && $hero_secondary_button_url) : ?>
                            <a class="partners-btn partners-btn--light" download href="<?php echo esc_url($hero_secondary_button_url); ?>">
                                <?php echo esc_html($hero_secondary_button_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if (have_rows('partners_hero_stats')) : ?>
                        <div class="partners-hero-stats">
                            <?php while (have_rows('partners_hero_stats')) : the_row();
                                $value = get_sub_field('value');
                                $label = get_sub_field('label');
                            ?>
                                <div class="partners-hero-stat">
                                    <?php if ($value) : ?>
                                        <div class="partners-hero-stat__value"><?php echo esc_html($value); ?></div>
                                    <?php endif; ?>
                                    <?php if ($label) : ?>
                                        <div class="partners-hero-stat__label"><?php echo esc_html($label); ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="partners-hero__form-card">
                    <?php if ($hero_form_title) : ?>
                        <h2 class="partners-form-card__title"><?php echo esc_html($hero_form_title); ?></h2>
                    <?php endif; ?>

                    <div class="partners-form-card__form-wrap" id="partners-apply-form">
                        <?php echo do_shortcode('[contact-form-7 id="58a2bab" title="Partner Apply Form"]'); ?>
                    </div>

                    <?php if ($hero_form_note) : ?>
                        <div class="partners-form-card__note"><?php echo esc_html($hero_form_note); ?></div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <?php if (have_rows('partners_logo_items')) : ?>
        <section class="partners-logos">
            <div class="partners-logos__head">
                <h2 class="partners-section__title">Your Reputation, Backed by Ours</h2>
                <p class="partners-logos__text">Strengthen your offering with internationally recognised accreditations, respected qualifications, and a brand trusted by over 148,000 learners worldwide.</p>
            </div>
            <div class="partners-container">
                <div class="partners-logos__grid">
                    <?php while (have_rows('partners_logo_items')) : the_row();
                        $title = get_sub_field('title');
                        $text  = get_sub_field('text');
                    ?>
                        <div class="partners-logo-item">
                            <?php if ($title) : ?>
                                <div class="partners-logo-item__title"><?php echo esc_html($title); ?></div>
                            <?php endif; ?>
                            <?php if ($text) : ?>
                                <div class="partners-logo-item__text"><?php echo esc_html($text); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="partners-section">
        <div class="partners-container">
            <?php if ($features_title) : ?>
                <h2 class="partners-section__title"><?php echo esc_html($features_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('partners_features')) : ?>
                <div class="partners-feature-grid">
                    <?php while (have_rows('partners_features')) : the_row();
                        $title = get_sub_field('title');
                        $text  = get_sub_field('text');
                    ?>
                        <article class="partners-card">
                            <?php if ($title) : ?>
                                <h3 class="partners-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($text) : ?>
                                <div class="partners-card__text"><?php echo esc_html($text); ?></div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="partners-section partners-feature-image">
        <div class="partners-container">
            <img
                src="<?php echo esc_url($img_tesol_logo_2); ?>"
                alt="TESOL accreditation"
                class="partners-feature-image__img"
                loading="lazy"
            />
        </div>
    </section>

    <section class="partners-section partners-section--alt">
        <div class="partners-container">
            <?php if ($steps_title) : ?>
                <h2 class="partners-section__title"><?php echo esc_html($steps_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('partners_steps')) : ?>
                <div class="partners-step-grid">
                    <?php while (have_rows('partners_steps')) : the_row();
                        $number = get_sub_field('number');
                        $title  = get_sub_field('title');
                        $text   = get_sub_field('text');
                    ?>
                        <article class="partners-step-card">
                            <?php if ($number) : ?>
                                <div class="partners-step-card__number"><?php echo esc_html($number); ?></div>
                            <?php endif; ?>
                            <?php if ($title) : ?>
                                <h3 class="partners-step-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($text) : ?>
                                <div class="partners-step-card__text"><?php echo esc_html($text); ?></div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="partners-section">
        <div class="partners-container">
            <?php if ($revenue_title) : ?>
                <h2 class="partners-section__title"><?php echo esc_html($revenue_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('partners_revenue_streams')) : ?>
                <div class="partners-revenue-grid">
                    <?php while (have_rows('partners_revenue_streams')) : the_row();
                        $title = get_sub_field('title');
                        $text  = get_sub_field('text');
                    ?>
                        <article class="partners-card partners-card--compact">
                            <?php if ($title) : ?>
                                <h3 class="partners-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($text) : ?>
                                <div class="partners-card__text"><?php echo esc_html($text); ?></div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="partners-section partners-revenue-image">
        <div class="partners-container">
            <img
                src="<?php echo esc_url($img_handshake); ?>"
                alt="Global partnerships"
                class="partners-revenue-image__img"
                loading="lazy"
            />
        </div>
    </section>

    <section class="partners-section">
        <div class="partners-container">
            <?php if ($case_studies_title) : ?>
                <h2 class="partners-section__title partners-section__title--with-line"><?php echo esc_html($case_studies_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('partners_case_studies')) : ?>
                <div class="partners-case-grid">
                    <?php while (have_rows('partners_case_studies')) : the_row();
                        $title       = get_sub_field('title');
                        $text        = get_sub_field('text');
                        $link_text   = get_sub_field('link_text');
                        $link_url    = get_sub_field('link_url');
                    ?>
                        <article class="partners-card">
                            <?php if ($title) : ?>
                                <h3 class="partners-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($text) : ?>
                                <div class="partners-card__text"><?php echo esc_html($text); ?></div>
                            <?php endif; ?>
                            <?php if ($link_text && $link_url) : ?>
                                <a class="partners-card__link js-dlopo-book-call" href="https://dlopo.com/chloe-joomun/intro-call"><?php echo esc_html($link_text); ?></a>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="partners-section partners-section--alt">
        <div class="partners-container">
            <div class="partners-support-grid">

                <div class="partners-support__content">
                    <?php if ($support_title) : ?>
                        <h2 class="partners-section__title"><?php echo esc_html($support_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($support_text) : ?>
                        <div class="partners-support__text">
                            <?php echo wp_kses_post(wpautop($support_text)); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('partners_support_points')) : ?>
                        <ul class="partners-support__list">
                            <?php while (have_rows('partners_support_points')) : the_row();
                                $text = get_sub_field('text');
                            ?>
                                <?php if ($text) : ?>
                                    <li><?php echo esc_html($text); ?></li>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($img_tesol_logo_1) : ?>
                        <div class="partners-support__media">
                            <img src="<?php echo esc_url($img_tesol_logo_1); ?>" alt="TESOL" loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="partners-support__form-card">
                    <?php if ($support_form_title) : ?>
                        <h3 class="partners-form-card__title"><?php echo esc_html($support_form_title); ?></h3>
                    <?php endif; ?>

                    <?php if ($support_form_text) : ?>
                        <div class="partners-form-card__text"><?php echo esc_html($support_form_text); ?></div>
                    <?php endif; ?>

                    <div class="partners-form-card__form" id="partners-country-report-form">
                        <?php echo do_shortcode('[contact-form-7 id="abc1234" title="Country Report Form"]'); ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php if ($bottom_cta_title || $bottom_cta_text || ($bottom_cta_button_text && $bottom_cta_button_url)) : ?>
        <section class="partners-bottom-cta">
            <div class="partners-container">
                <div class="partners-bottom-cta__box">
                    <?php if ($bottom_cta_title) : ?>
                        <h2 class="partners-bottom-cta__title"><?php echo esc_html($bottom_cta_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($bottom_cta_text) : ?>
                        <div class="partners-bottom-cta__text"><?php echo esc_html($bottom_cta_text); ?></div>
                    <?php endif; ?>

                    <?php if ($bottom_cta_button_text) : ?>
                        <a class="partners-btn partners-btn--white js-book-call" href="#partners-apply-form">
                            <?php echo esc_html($bottom_cta_button_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $team = get_field('teams_section');

    if ($team ) :
        $team_title   = $team['section_title']   ?? '';
        $team_summary = $team['section_summary'] ?? '';
        $team_row1    = !empty($team['teams_row_1']) ? $team['teams_row_1'] : array();
        $team_row2    = !empty($team['teams_row_2']) ? $team['teams_row_2'] : array();

        if ($team_title || $team_summary || $team_row1 || $team_row2) :

            $render_team_card = function ($img_url, $img_alt, $name, $summary) {
                ob_start(); ?>
                <article class="partners-team-card">
                    <div class="partners-team-card__avatar">
                        <?php if ($img_url) : ?>
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <?php if ($name) : ?>
                        <h3 class="partners-team-card__name"><?php echo esc_html($name); ?></h3>
                    <?php endif; ?>
                    <?php if ($summary) : ?>
                        <div class="partners-team-card__summary">
                            <p><?php echo esc_html($summary); ?></p>
                            <button type="button" class="partners-team-card__toggle" aria-label="Read more">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </article>
                <?php
                return ob_get_clean();
            };
            ?>

            <section class="partners-section partners-team">
                <div class="partners-container">

                    <?php if ($team_title || $team_summary) : ?>
                        <div class="partners-team__head">
                            <?php if ($team_title) : ?>
                                <h2 class="partners-team__title"><?php echo esc_html($team_title); ?></h2>
                            <?php endif; ?>
                            <?php if ($team_summary) : ?>
                                <p class="partners-team__summary"><?php echo esc_html($team_summary); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($team_row1) : ?>
                        <div class="partners-team-slider">
                            <button type="button" class="partners-team-slider__nav partners-team-slider__nav--prev" aria-label="Previous">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>

                            <div class="partners-team-slider__viewport">
                                <div class="partners-team-slider__track">
                                    <?php foreach ($team_row1 as $member) :
                                        $img  = $member['image'] ?? '';          // ARRAY (return format = array)
                                        $name = $member['name'] ?? '';
                                        $sum  = $member['summary'] ?? '';
                                        $url  = is_array($img) ? ($img['url'] ?? '') : $img;
                                        $alt  = is_array($img) ? (($img['alt'] ?: $name)) : $name;
                                    ?>
                                        <div class="partners-team-slide">
                                            <?php echo $render_team_card($url, $alt, $name, $sum); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <button type="button" class="partners-team-slider__nav partners-team-slider__nav--next" aria-label="Next">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($team_row2) : ?>
                        <div class="partners-team-grid">
                            <?php foreach ($team_row2 as $member) :
                                $url  = $member['image'] ?? '';   // URL string (return format = url)
                                $name = $member['name'] ?? '';
                                $sum  = $member['summary'] ?? '';
                            ?>
                                <?php echo $render_team_card($url, $name, $name, $sum); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>

            <?php
        endif;
    endif;
    ?>

</main>
<script>
(function () {
    var wrap = document.getElementById('partners-apply-form');
    if (!wrap) return;

    var form = wrap.querySelector('form.wpcf7-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        if (wrap.classList.contains('is-expanded')) return;

        var fullName = form.querySelector('[name="full-name"]');
        var email    = form.querySelector('[name="email"]');
        var country  = form.querySelector('[name="country"]');

        var missing = [];
        if (fullName && !fullName.value.trim())            missing.push(fullName);
        if (email    && !isValidEmail(email.value.trim())) missing.push(email);
        if (country  && !country.value.trim())             missing.push(country);

        if (missing.length) {
            e.preventDefault();
            e.stopPropagation();
            highlightMissing(missing);
            missing[0].focus();
            return false;
        }

        e.preventDefault();
        e.stopPropagation();
        wrap.classList.add('is-expanded');

        setTimeout(function () {
            var firstExpand = wrap.querySelector('.cf7-row--expand input, .cf7-row--expand textarea');
            if (firstExpand) {
                firstExpand.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(function () { firstExpand.focus({ preventScroll: true }); }, 400);
            }
        }, 100);

        return false;
    }, true);

    function pulseForm() {
        var card = wrap.closest('.partners-hero__form-card') || wrap;
        card.classList.add('is-pulsing');
        setTimeout(function () {
            card.classList.remove('is-pulsing');
        }, 1400);
    }

    function isValidEmail(v) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    }

    function highlightMissing(fields) {
        fields.forEach(function (f) {
            f.classList.add('wpcf7-not-valid');
            f.addEventListener('input', function clearError() {
                f.classList.remove('wpcf7-not-valid');
                f.removeEventListener('input', clearError);
            });
        });
    }
})();

(function () {
    var slider = document.querySelector('.partners-team-slider');
    if (!slider) return;
    var track  = slider.querySelector('.partners-team-slider__track');
    var slides = Array.prototype.slice.call(track.children);
    var prev   = slider.querySelector('.partners-team-slider__nav--prev');
    var next   = slider.querySelector('.partners-team-slider__nav--next');
    var index  = 0;

    function visibleCount() {
        var w = window.innerWidth;
        if (w <= 640) return 1;
        if (w <= 1024) return 2;
        return 3;
    }
    function gap() {
        var cs = getComputedStyle(track);
        return parseFloat(cs.columnGap || cs.gap) || 0;
    }
    function maxIndex() { return Math.max(0, slides.length - visibleCount()); }
    function step() { return slides.length ? slides[0].getBoundingClientRect().width + gap() : 0; }

    function placeArrows() {
        var a = track.querySelector('.partners-team-card__avatar');
        if (!a) return;
        var s = slider.getBoundingClientRect();
        var r = a.getBoundingClientRect();
        var top = (r.top - s.top + r.height / 2) + 'px';
        prev.style.top = top;
        next.style.top = top;
    }
    function update() {
        var hasOverflow = slides.length > visibleCount();

        slider.classList.toggle('is-static', !hasOverflow);  

        prev.style.display = hasOverflow ? '' : 'none';
        next.style.display = hasOverflow ? '' : 'none';

        if (!hasOverflow) {
            index = 0;
            track.style.transform = 'translateX(0)';
            return;
        }

        index = Math.min(index, maxIndex());
        track.style.transform = 'translateX(' + (-index * step()) + 'px)';
        prev.disabled = index <= 0;
        next.disabled = index >= maxIndex();
        placeArrows();
    }

    prev.addEventListener('click', function () { index = Math.max(0, index - 1); update(); });
    next.addEventListener('click', function () { index = Math.min(maxIndex(), index + 1); update(); });
    window.addEventListener('resize', update);
    window.addEventListener('load', update);
    update();

    document.querySelectorAll('.partners-team-card__toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.partners-team-card').classList.toggle('is-open');
        });
    });
})();
</script>
<button
  id="dlopo-partner-popup-trigger"
  type="button"
  data-dlopo-embed="true"
  aria-hidden="true"
  tabindex="-1"
  style="display:none"
></button>

<script>
  window.dlopoEmbed = {
    mode: "element",
    ownerUsername: "chloe-joomun",
    linkSlug: "intro-call"
  };
</script>
<script src="https://dlopo.com/embed.js" defer></script>
<script>
document.addEventListener('click', function (e) {
    var button = e.target.closest('.js-dlopo-book-call');
    if (!button) return;

    e.preventDefault();

    var trigger = document.getElementById('dlopo-partner-popup-trigger');

    if (trigger) {
        trigger.click();
    }
});
</script>
<?php
get_footer();