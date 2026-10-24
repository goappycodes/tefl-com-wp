<?php
/**
 * Single blog post â€” redesign template (v2).
 * Routed here by ti_use_blog_redesign() (includes/ti-blog-redesign.php).
 *
 * @package teflinstitute
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$pid        = get_the_ID();
	$img_dir    = get_stylesheet_directory_uri() . '/assets/img/blog-redesign';
	$hero       = get_the_post_thumbnail_url( $pid, 'full' );
	if ( ! $hero ) {
		$banner = get_field( 'banner' );
		$hero   = $banner['background_image'] ?? '';
	}
	// Sidebar shows exactly two data-capture tools (ticked per post; default salary + prospectus).
	$sidebar_tools = get_field( 'sidebar_tools' );
	if ( ! is_array( $sidebar_tools ) || count( $sidebar_tools ) < 2 ) {
		// Back-compat with the earlier two-select fields, then default.
		$sidebar_tools = array_filter( array(
			get_field( 'sidebar_tool_1' ) ?: ( get_field( 'featured_tool' ) ?: 'salary' ),
			get_field( 'sidebar_tool_2' ) ?: 'prospectus',
		) );
	}
	$show_wire     = get_field( 'show_hire_wire' );
	$show_wire     = ( '' === $show_wire || null === $show_wire ) ? true : (bool) $show_wire;
	$promo_style   = get_field( 'promo_strip_style' ) ?: 'steady';
	$show_promo    = get_field( 'show_promo_strip' );
	$show_promo    = ( '' === $show_promo || null === $show_promo ) ? true : (bool) $show_promo;
	$intro         = trim( (string) get_field( 'blog_intro' ) );
	$takeaways     = get_field( 'key_takeaways' );
	$reading       = function_exists( 'get_reading_time' ) ? get_reading_time( get_the_content() ) : 0;
	$cta_url       = tibr_opt( 'tibr_cta_url', 'https://teflinstitute.com/tefl-courses/' );
	$share_url     = get_permalink();
	$share_title   = get_the_title();
	?>

<div class="ti-blog-redesign" data-post-id="<?php echo (int) $pid; ?>" data-post-title="<?php echo esc_attr( get_the_title() ); ?>">

	<div class="tibr-progress" id="tibrProgress" aria-hidden="true"></div>

	<!-- HERO -->
	<section class="tibr-hero tibr-bleed"<?php echo $hero ? ' style="background-image:url(\'' . esc_url( $hero ) . '\')"' : ''; ?>>
		<div class="tibr-hero__overlay"></div>
		<div class="tibr-hero__inner">
			<?php
			$bc = function_exists( 'yoast_breadcrumb' ) ? yoast_breadcrumb( '<nav class="tibr-breadcrumb">', '</nav>', false ) : '';
			if ( trim( wp_strip_all_tags( (string) $bc ) ) ) {
				echo $bc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Yoast output.
			} else {
				$cat    = get_the_category();
				$crumbs = array( '<a href="' . esc_url( home_url( '/blog/' ) ) . '">Blog</a>' );
				if ( ! empty( $cat ) ) {
					$primary = $cat[0];
					foreach ( array_reverse( get_ancestors( $primary->term_id, 'category' ) ) as $aid ) {
						$t = get_term( $aid, 'category' );
						if ( $t && ! is_wp_error( $t ) ) {
							$crumbs[] = '<a href="' . esc_url( get_category_link( $t ) ) . '">' . esc_html( $t->name ) . '</a>';
						}
					}
					$crumbs[] = '<a href="' . esc_url( get_category_link( $primary ) ) . '">' . esc_html( $primary->name ) . '</a>';
				}
				echo '<nav class="tibr-breadcrumb">' . implode( ' / ', $crumbs ) . '</nav>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
			<h1 class="tibr-hero__title"><?php the_title(); ?></h1>
			<div class="tibr-hero__meta">
				<span>By <strong><?php the_author(); ?></strong></span>
				<span class="tibr-sep"></span>
				<span>Published <?php echo esc_html( get_the_date( 'jS F Y' ) ); ?></span>
				<?php if ( $reading ) : ?>
					<span class="tibr-sep"></span>
					<span><?php echo (int) $reading; ?> min read</span>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- PROMO STRIP -->
	<?php if ( $show_promo ) :
	$promo_link  = tibr_opt( 'tibr_promo_link', $cta_url );
	$promo_pill  = tibr_opt( 'tibr_promo_pill', 'Free Teaser Course With Certificate' );
	$promo_title = tibr_opt( 'tibr_promo_title', 'Teaching English: Your First Lesson' );
	$promo_sub   = tibr_opt( 'tibr_promo_sub', 'Try To See if teaching is for You' );
	$promo_cta   = tibr_opt( 'tibr_promo_cta', 'Start Now' );
	if ( 'scrolling' === $promo_style ) : ?>
		<a class="tibr-promo tibr-promo--scroll tibr-bleed" href="<?php echo esc_url( $promo_link ); ?>">
			<span class="tibr-promo__track">
				<?php for ( $m = 0; $m < 8; $m++ ) : ?>
					<span class="tibr-promo__group">
						<span class="tibr-promo__pill"><?php echo esc_html( $promo_pill ); ?></span>
						<span class="tibr-promo__text"><strong><?php echo esc_html( $promo_title ); ?></strong> &middot; <?php echo esc_html( $promo_sub ); ?></span>
						<span class="tibr-promo__cta"><?php echo esc_html( $promo_cta ); ?> &rarr;</span>
						<span class="tibr-promo__star">&#10022;</span>
					</span>
				<?php endfor; ?>
			</span>
		</a>
	<?php else : ?>
		<a class="tibr-promo tibr-bleed" href="<?php echo esc_url( $promo_link ); ?>">
			<span class="tibr-promo__pill"><?php echo esc_html( $promo_pill ); ?></span>
			<span class="tibr-promo__text"><strong><?php echo esc_html( $promo_title ); ?></strong> &middot; <?php echo esc_html( $promo_sub ); ?></span>
			<span class="tibr-promo__cta"><?php echo esc_html( $promo_cta ); ?> &rarr;</span>
		</a>
	<?php endif; ?>
	<?php endif; // $show_promo ?>

	<!-- BODY -->
	<div class="tibr-body">

		<article class="tibr-article">
			<?php
			if ( $intro ) {
				echo '<p class="tibr-lead">' . esc_html( $intro ) . '</p>';
			}
			if ( $takeaways && is_array( $takeaways ) ) : ?>
				<div class="tibr-takeaways">
					<p class="tibr-eyebrow">Key takeaways</p>
					<ul>
						<?php foreach ( $takeaways as $t ) : ?>
							<li><?php echo esc_html( $t['text'] ?? '' ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php
			// Render the post body, inserting the Hire Wire block roughly halfway through.
			$content_html = apply_filters( 'the_content', get_the_content() );
			$content_html = tibr_style_takeaways( $content_html );
			if ( $show_wire ) {
				ob_start(); ?>
				<section class="tibr-wire">
					<div class="tibr-wire__left">
						<span class="tibr-wire__kicker">Free fortnightly email</span>
						<div class="tibr-wire__mark"><strong>Hire</strong> <span>Wire</span></div>
						<p class="tibr-wire__lede">Every TEFL opening, salary and deadline that matters.</p>
						<form class="tibr-wire__form" onsubmit="return hwTiSub(this, event)" style="margin:0">
							<input class="tibr-wire__input" type="email" name="email" placeholder="Your email address" required>
							<input class="tibr-btn tibr-btn--accent tibr-wire__btn" type="submit" value="Get on the Wire">
							<div class="hw-form-msg"></div>
						</form>
						<p class="tibr-wire__fine">In your inbox every two weeks. Free, no spam, unsubscribe any time.</p>
					</div>
					<div class="tibr-wire__right">
						<span class="tibr-wire__rkicker">In every issue</span>
						<div class="tibr-wire__row"><span class="tibr-wire__num">01</span><span><span class="tibr-wire__rt">Salaries</span><br><span class="tibr-wire__rs">Teacher pay by country</span></span></div>
						<div class="tibr-wire__row"><span class="tibr-wire__num">02</span><span><span class="tibr-wire__rt">Jobs</span><br><span class="tibr-wire__rs">New TEFL openings</span></span></div>
						<div class="tibr-wire__row"><span class="tibr-wire__num">03</span><span><span class="tibr-wire__rt">Deadlines</span><br><span class="tibr-wire__rs">Programme and visa dates</span></span></div>
					</div>
				</section>
				<?php
				$content_html = tibr_inject_midpoint( $content_html, ob_get_clean() );
			}
			echo '<div class="tibr-content' . ( $intro ? '' : ' tibr-content--autolead' ) . '">' . $content_html . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>

			<div class="tibr-cta-wrap">
				<a class="tibr-btn tibr-btn--accent" href="<?php echo esc_url( $cta_url ); ?>">Get TEFL qualified for your gap year <?php echo tibr_icon( 'arrow-right', 18 ); ?></a>
			</div>

			<!-- Podcast -->
			<a class="tibr-podcast" href="https://www.youtube.com/@tefl-institute/podcasts" target="_blank" rel="noopener">
				<div class="tibr-podcast__media">
					<img src="<?php echo esc_url( $img_dir . '/podcast-banner.png' ); ?>" alt="Tune In With TEFL podcast with Tara and Jess">
					<span class="tibr-podcast__play"><?php echo tibr_icon( 'play', 20 ); ?></span>
				</div>
				<div class="tibr-podcast__text">
					<span class="tibr-podcast__pill"><?php echo tibr_icon( 'headphones', 14 ); ?> Podcast on YouTube</span>
					<div class="tibr-podcast__mark"><strong>Tune in</strong> <span>with TEFL</span></div>
					<p class="tibr-podcast__desc">Tara and Jess talk through different TEFL and EFL topics, from finding work abroad to life in the classroom.</p>
					<div class="tibr-podcast__chips">
						<span class="tibr-podcast__chip tibr-podcast__chip--listen"><?php echo tibr_icon( 'play', 16 ); ?> Listen now</span>
						<span class="tibr-podcast__chip tibr-podcast__chip--sub">Subscribe</span>
					</div>
				</div>
			</a>

			<!-- FAQs -->
			<?php $faqs = function_exists( 'get_cfvalue_by_country' ) ? get_cfvalue_by_country( 'frequently_asked_questions' ) : get_field( 'frequently_asked_questions' );
			if ( $faqs && is_array( $faqs ) ) : ?>
				<section class="tibr-faqs">
					<div class="tibr-faqs__head">
						<p class="tibr-eyebrow">FAQs</p>
						<h2 class="tibr-faqs__title">Questions students ask us</h2>
					</div>
					<?php foreach ( $faqs as $n => $faq ) :
						$num = str_pad( $n + 1, 2, '0', STR_PAD_LEFT ); ?>
						<div class="tibr-faq<?php echo 0 === $n ? ' is-open' : ''; ?>">
							<button class="tibr-faq__q" type="button" aria-expanded="<?php echo 0 === $n ? 'true' : 'false'; ?>">
								<span class="tibr-faq__num"><?php echo esc_html( $num ); ?></span>
								<span class="tibr-faq__t"><?php echo esc_html( $faq['question'] ); ?></span>
								<span class="tibr-faq__sign" aria-hidden="true"><?php echo 0 === $n ? '&minus;' : '+'; ?></span>
							</button>
							<div class="tibr-faq__a"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
						</div>
					<?php endforeach; ?>
					<script type="application/ld+json">
					{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
					<?php
					$c = count( $faqs ); $k = 0;
					foreach ( $faqs as $faq ) {
						$k++;
						echo '{"@type":"Question","name":' . wp_json_encode( $faq['question'] ) . ',"acceptedAnswer":{"@type":"Answer","text":' . wp_json_encode( wp_strip_all_tags( $faq['answer'] ) ) . '}}';
						if ( $k !== $c ) { echo ','; }
					}
					?>
					]}
					</script>
				</section>
			<?php endif; ?>
		</article>

		<aside class="tibr-aside">
			<p class="tibr-aside__eyebrow">Free tools for your gap year</p>
			<?php echo tibr_render_tool_cards( $sidebar_tools ); ?>

			<?php
			$author_id   = get_the_author_meta( 'ID' );
			$author_name = get_the_author();
			$author_bio  = get_the_author_meta( 'description' );
			$author_img  = get_field( 'author_image', 'user_' . $author_id );
			$author_img  = $author_img ? ( is_array( $author_img ) ? $author_img['url'] : $author_img ) : '';
			if ( ! $author_img ) {
				$author_img = get_avatar_url( $author_id, array( 'size' => 144 ) );
			}
			?>
			<div class="tibr-author">
				<img class="tibr-author__photo" src="<?php echo esc_url( $author_img ); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
				<div>
					<p class="tibr-author__eyebrow">Written by</p>
					<p class="tibr-author__name"><?php echo esc_html( $author_name ); ?></p>
					<?php if ( $author_bio ) : ?><p class="tibr-author__bio" id="tibrAuthorBio"><?php echo esc_html( $author_bio ); ?></p><button type="button" class="tibr-author__readmore" aria-expanded="false" aria-controls="tibrAuthorBio">Read full bio</button><?php endif; ?>
					<a class="tibr-author__more" href="<?php echo esc_url( tibr_opt( 'tibr_team_url', 'https://teflinstitute.com/meet-the-team/' ) ); ?>">More from <?php echo esc_html( $author_name ); ?></a>
				</div>
			</div>
		</aside>
	</div>

	<!-- COUNTRY GUIDES (reuse deterministic 5-of-15) -->
	<?php
	$tg_guides = array(
		array( 'Spain', 'Jobs, pay and visa routes', 'ES', 'teach-english-in-spain' ),
		array( 'South Korea', 'EPIK, hagwons and pay', 'KR', 'south-korea' ),
		array( 'Japan', 'JET, ALT and eikaiwa pay', 'JP', 'japan' ),
		array( 'Vietnam', 'Work permits and requirements', 'VN', 'vietnam' ),
		array( 'Thailand', 'Visas and teaching licences', 'TH', 'thailand' ),
		array( 'Italy', 'Jobs, pay and visa routes', 'IT', 'italy' ),
		array( 'Dubai', 'Pay, requirements and visas', 'AE', 'dubai' ),
		array( 'Czech Republic', 'Pay, visas and cities', 'CZ', 'czech-republic' ),
		array( 'Cambodia', 'Pay, requirements and visas', 'KH', 'cambodia' ),
		array( 'Estonia', 'Jobs, pay and work routes', 'EE', 'estonia' ),
		array( 'China', 'Z visa, pay and cities', 'CN', 'china' ),
		array( 'Taiwan', 'Buxibans, pay and visas', 'TW', 'taiwan' ),
		array( 'Mexico', 'Jobs, pay and cities', 'MX', 'mexico' ),
		array( 'Germany', 'Freelance work and pay', 'DE', 'germany' ),
		array( 'Portugal', 'Jobs, pay and visa routes', 'PT', 'portugal' ),
	);
	mt_srand( (int) $pid );
	shuffle( $tg_guides );
	mt_srand();
	$tg_pick    = array_slice( $tg_guides, 0, 5 );
	$guides_all = tibr_opt( 'tibr_guides_url', 'https://teflinstitute.com/teach-english-jobs/' );
	?>
	<section class="tibr-guides tibr-bleed">
		<div class="tibr-guides__inner">
			<div class="tibr-guides__head">
				<div>
					<p class="tibr-guides__eyebrow">Plan for 2027</p>
					<h2 class="tibr-guides__mark"><strong>TEFL Institute</strong> <span>guides</span></h2>
				</div>
				<a class="tibr-btn tibr-btn--accent" href="<?php echo esc_url( $guides_all ); ?>">See all 63 country guides <?php echo tibr_icon( 'arrow-right', 18 ); ?></a>
			</div>
			<div class="tibr-guides__grid">
				<?php foreach ( $tg_pick as $g ) : ?>
					<a class="tibr-guide" href="<?php echo esc_url( 'https://teflinstitute.com/teach-english-abroad/' . $g[3] . '/' ); ?>">
						<span class="tibr-guide__code" aria-hidden="true"><?php echo esc_html( $g[2] ); ?></span>
						<h3 class="tibr-guide__c"><?php echo esc_html( $g[0] ); ?></h3>
						<p class="tibr-guide__d"><?php echo esc_html( $g[1] ); ?></p>
						<span class="tibr-guide__cta">Read the guide &rarr;</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- RELATED -->
	<?php
	$related = tibr_related_posts( $pid, 3 );
	if ( ! empty( $related ) ) :
		$cat      = get_the_category();
		$all_link = ! empty( $cat ) ? get_category_link( $cat[0]->term_id ) : home_url( '/blog/' );
		?>
		<section class="tibr-related">
			<div class="tibr-related__head">
				<h2 class="tibr-related__title">Keep reading</h2>
				<a class="tibr-related__all" href="<?php echo esc_url( $all_link ); ?>">All articles &rarr;</a>
			</div>
			<div class="tibr-related__grid">
				<?php foreach ( $related as $rp ) :
					$rimg = get_the_post_thumbnail_url( $rp->ID, 'medium_large' );
					$rcat = get_the_category( $rp->ID ); ?>
					<a class="tibr-rcard" href="<?php echo esc_url( get_permalink( $rp->ID ) ); ?>">
						<span class="tibr-rcard__img"<?php echo $rimg ? ' style="background-image:url(\'' . esc_url( $rimg ) . '\')"' : ''; ?>></span>
						<?php if ( ! empty( $rcat ) ) : ?><span class="tibr-rcard__cat"><?php echo esc_html( $rcat[0]->name ); ?></span><?php endif; ?>
						<h3 class="tibr-rcard__t"><?php echo esc_html( get_the_title( $rp->ID ) ); ?></h3>
						<span class="tibr-rcard__read">Read &rarr;</span>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- CATEGORIES + SHARE -->
	<?php $cats = get_the_category(); ?>
	<section class="tibr-filed">
		<div class="tibr-filed__col">
			<p class="tibr-filed__eyebrow">Filed under</p>
			<div class="tibr-tags">
				<?php if ( ! empty( $cats ) ) : foreach ( $cats as $c ) : ?>
					<a class="tibr-tag" href="<?php echo esc_url( get_category_link( $c->term_id ) ); ?>"><?php echo esc_html( $c->name ); ?></a>
				<?php endforeach; endif; ?>
			</div>
		</div>
		<div class="tibr-filed__col">
			<p class="tibr-filed__eyebrow">Share</p>
			<div class="tibr-share">
				<a href="https://www.facebook.com/sharer.php?u=<?php echo rawurlencode( $share_url ); ?>" target="_blank" rel="noopener" aria-label="Share on Facebook"><?php echo tibr_icon( 'facebook', 18 ); ?></a>
				<a href="https://twitter.com/share?url=<?php echo rawurlencode( $share_url ); ?>&text=<?php echo rawurlencode( $share_title ); ?>" target="_blank" rel="noopener" aria-label="Share on X"><?php echo tibr_icon( 'twitter', 18 ); ?></a>
				<a href="https://www.linkedin.com/shareArticle?url=<?php echo rawurlencode( $share_url ); ?>&title=<?php echo rawurlencode( $share_title ); ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><?php echo tibr_icon( 'linkedin', 18 ); ?></a>
				<a href="#" class="tibr-copy" data-url="<?php echo esc_url( $share_url ); ?>" aria-label="Copy link"><?php echo tibr_icon( 'link', 18 ); ?></a>
			</div>
		</div>
	</section>

</div><!-- .ti-blog-redesign -->

<?php
endwhile;

get_footer();
