<?php
/**
* Template Name: Japan Page Template
*
* @package WordPress
* @subpackage teflinstitute
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

// All hero content is managed from the "Japan Page Fields > Hero Banner" ACF group.
$hero = get_field( 'japan_hero' );

if ( $hero ) :

	$hero_bg       = ! empty( $hero['background_image'] ) ? $hero['background_image'] : '';
	$hero_overlay  = ! empty( $hero['overlay_image'] ) ? $hero['overlay_image'] : '';
	$hero_eyebrow  = ! empty( $hero['eyebrow'] ) ? $hero['eyebrow'] : '';
	$hero_heading  = ! empty( $hero['heading'] ) ? $hero['heading'] : '';
	$hero_text     = ! empty( $hero['description'] ) ? $hero['description'] : '';
	$primary_cta   = ! empty( $hero['primary_cta'] ) ? $hero['primary_cta'] : array();
	$secondary_cta = ! empty( $hero['secondary_cta'] ) ? $hero['secondary_cta'] : array();
	$hero_cards    = ! empty( $hero['cards'] ) ? $hero['cards'] : array();

	// Build the inline style only for the image properties that are set.
	$hero_styles = array();
	if ( $hero_bg ) {
		$hero_styles[] = "background-image: url('" . esc_url( $hero_bg ) . "')";
	}
	if ( $hero_overlay ) {
		$hero_styles[] = "--japan-hero-overlay: url('" . esc_url( $hero_overlay ) . "')";
	}
	$hero_style_attr = $hero_styles ? ' style="' . esc_attr( implode( '; ', $hero_styles ) ) . '"' : '';

	// Only render the banner when some content has actually been added.
	$hero_has_content = ( $hero_bg || $hero_overlay || $hero_eyebrow || $hero_heading || $hero_text
		|| ! empty( $primary_cta['title'] ) || ! empty( $secondary_cta['title'] ) || ! empty( $hero_cards ) );

	if ( $hero_has_content ) :
		?>

	<!-- Japan Hero Banner -->
	<section class="japan-hero<?php echo $hero_overlay ? ' has-overlay' : ''; ?>"<?php echo $hero_style_attr; ?>>
		<div class="ast-container">
			<div class="japan-hero__inner">

				<?php if ( $hero_eyebrow ) : ?>
					<span class="japan-hero__eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></span>
				<?php endif; ?>

				<?php if ( $hero_heading ) : ?>
					<h1 class="japan-hero__heading"><?php echo esc_html( $hero_heading ); ?></h1>
				<?php endif; ?>

				<?php if ( $hero_text ) : ?>
					<p class="japan-hero__desc"><?php echo esc_html( $hero_text ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $primary_cta['title'] ) || ! empty( $secondary_cta['title'] ) ) : ?>
					<div class="japan-hero__cta">
						<?php if ( ! empty( $primary_cta['title'] ) ) : ?>
							<a href="<?php echo esc_url( $primary_cta['url'] ); ?>"
								class="japan-btn japan-btn--primary"
								<?php echo ! empty( $primary_cta['target'] ) ? 'target="' . esc_attr( $primary_cta['target'] ) . '"' : ''; ?>>
								<?php echo esc_html( $primary_cta['title'] ); ?>
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $secondary_cta['title'] ) ) : ?>
							<a href="<?php echo esc_url( $secondary_cta['url'] ); ?>"
								class="japan-btn japan-btn--outline"
								<?php echo ! empty( $secondary_cta['target'] ) ? 'target="' . esc_attr( $secondary_cta['target'] ) . '"' : ''; ?>>
								<?php echo esc_html( $secondary_cta['title'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $hero_cards ) ) : ?>
					<div class="japan-hero__cards">
						<?php foreach ( $hero_cards as $card ) : ?>
							<div class="japan-hero__card">
								<?php if ( ! empty( $card['title'] ) ) : ?>
									<h3 class="japan-hero__card-title"><?php echo esc_html( $card['title'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $card['subtitle'] ) ) : ?>
									<span class="japan-hero__card-subtitle"><?php echo esc_html( $card['subtitle'] ); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		</div>

		<span class="japan-hero__corners" aria-hidden="true">
			<span class="japan-hero__corner japan-hero__corner--tl"></span>
			<span class="japan-hero__corner japan-hero__corner--tr"></span>
			<span class="japan-hero__corner japan-hero__corner--bl"></span>
			<span class="japan-hero__corner japan-hero__corner--br"></span>
		</span>
	</section>
	<!-- /Japan Hero Banner -->

		<?php
	endif;
endif;
?>

<?php
// Sticky Table of Contents — managed from the "Japan Page Fields > Table of Contents" ACF group.
// Rendered right after the banner: fixed floating box on desktop, sticky top bar on small screens.
$toc = get_field( 'japan_toc' );

if ( $toc ) :

	$toc_heading = ! empty( $toc['heading'] ) ? $toc['heading'] : '';
	$toc_links   = ! empty( $toc['links'] ) ? $toc['links'] : array();
	$toc_btn     = ! empty( $toc['button'] ) ? $toc['button'] : array();

	if ( $toc_links ) :
		?>

		<!-- Sticky Table of Contents -->
		<nav class="japan-toc" aria-label="Table of contents">
			<div class="japan-toc__inner">

				<?php if ( $toc_heading ) : ?>
					<span class="japan-toc__title"><?php echo esc_html( $toc_heading ); ?></span>
				<?php endif; ?>

				<ul class="japan-toc__list">
					<?php foreach ( $toc_links as $i => $link ) : ?>
						<?php if ( empty( $link['label'] ) ) { continue; } ?>
						<li class="japan-toc__item">
							<a class="japan-toc__link<?php echo 0 === $i ? ' japan-toc__link--lead' : ''; ?>" href="#" data-target="<?php echo esc_attr( ! empty( $link['target'] ) ? $link['target'] : '' ); ?>">
								<?php if ( 0 === $i ) : ?>
									<img class="japan-toc__plane" src="https://teflinstitute.com/wp-content/uploads/2026/09/Vector.png" alt="" aria-hidden="true" width="19" height="21" />
								<?php endif; ?>
								<span><?php echo esc_html( $link['label'] ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

				<?php if ( ! empty( $toc_btn['title'] ) ) : ?>
					<a class="japan-toc__btn" href="<?php echo esc_url( $toc_btn['url'] ); ?>"<?php echo ! empty( $toc_btn['target'] ) ? ' target="' . esc_attr( $toc_btn['target'] ) . '"' : ''; ?>>
						<?php echo esc_html( $toc_btn['title'] ); ?>
					</a>
				<?php endif; ?>

			</div>
		</nav>
		<!-- /Sticky Table of Contents -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > At a Glance" ACF group.
$glance = get_field( 'japan_glance' );

if ( $glance ) :

	$g_eyebrow = ! empty( $glance['eyebrow'] ) ? $glance['eyebrow'] : '';
	$g_heading = ! empty( $glance['heading'] ) ? $glance['heading'] : '';
	$g_desc    = ! empty( $glance['description'] ) ? $glance['description'] : '';
	$g_stats   = ! empty( $glance['stats'] ) ? $glance['stats'] : array();

	if ( $g_eyebrow || $g_heading || $g_desc || $g_stats ) :
		?>

		<!-- Japan At a Glance -->
		<section class="japan-glance">
			<div class="ast-container">

				<?php if ( $g_eyebrow || $g_heading || $g_desc ) : ?>
					<div class="japan-glance__intro">
						<?php if ( $g_eyebrow ) : ?>
							<span class="japan-glance__eyebrow"><?php echo esc_html( $g_eyebrow ); ?></span>
						<?php endif; ?>
						<?php if ( $g_heading ) : ?>
							<h2 class="japan-glance__heading"><?php echo esc_html( $g_heading ); ?></h2>
						<?php endif; ?>
						<?php if ( $g_desc ) : ?>
							<p class="japan-glance__desc"><?php echo esc_html( $g_desc ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $g_stats ) ) : ?>
					<div class="japan-glance__stats">
						<?php foreach ( $g_stats as $stat ) : ?>
							<div class="japan-glance__stat">
								<?php if ( ! empty( $stat['value'] ) ) : ?>
									<span class="japan-glance__stat-value"><?php echo esc_html( $stat['value'] ); ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $stat['label'] ) ) : ?>
									<span class="japan-glance__stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Japan At a Glance -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Requirements Table" ACF group.
// (Used on the Requirements page; hidden anywhere it has no content.)
$reqtable = get_field( 'japan_reqtable' );

if ( $reqtable ) :

	$rt_heading = ! empty( $reqtable['heading'] ) ? $reqtable['heading'] : '';
	$rt_rows    = ! empty( $reqtable['rows'] ) ? $reqtable['rows'] : array();

	// Column definitions: header label + the matching row cell key.
	$rt_col_defs = array(
		array( 'label' => ! empty( $reqtable['col1_label'] ) ? $reqtable['col1_label'] : '', 'cell' => 'c1' ),
		array( 'label' => ! empty( $reqtable['col2_label'] ) ? $reqtable['col2_label'] : '', 'cell' => 'c2' ),
		array( 'label' => ! empty( $reqtable['col3_label'] ) ? $reqtable['col3_label'] : '', 'cell' => 'c3' ),
		array( 'label' => ! empty( $reqtable['col4_label'] ) ? $reqtable['col4_label'] : '', 'cell' => 'c4' ),
		array( 'label' => ! empty( $reqtable['col5_label'] ) ? $reqtable['col5_label'] : '', 'cell' => 'c5' ),
	);

	// Only keep columns that carry content: a header label, or a value in any row.
	// This lets the same section render a 2-column table without leaving empty cells.
	$rt_cols = array();
	foreach ( $rt_col_defs as $def ) {
		$has_value = ( '' !== $def['label'] );
		if ( ! $has_value ) {
			foreach ( $rt_rows as $row ) {
				if ( ! empty( $row[ $def['cell'] ] ) ) {
					$has_value = true;
					break;
				}
			}
		}
		if ( $has_value ) {
			$rt_cols[] = $def;
		}
	}

	// Show the header row only if at least one visible column has a label.
	$rt_has_cols = false;
	foreach ( $rt_cols as $def ) {
		if ( '' !== $def['label'] ) {
			$rt_has_cols = true;
			break;
		}
	}

	if ( $rt_heading || ( $rt_rows && $rt_cols ) ) :
		?>

		<!-- Minimum legal requirements vs employer preferences -->
		<section class="japan-reqtable">
			<div class="ast-container">

				<?php if ( $rt_heading ) : ?>
					<h2 class="japan-reqtable__heading"><?php echo esc_html( $rt_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $rt_rows ) && ! empty( $rt_cols ) ) : ?>
					<div class="japan-reqtable__wrap">
						<table class="japan-reqtable__table">
							<?php if ( $rt_has_cols ) : ?>
								<thead>
									<tr>
										<?php foreach ( $rt_cols as $def ) : ?>
											<th><?php echo esc_html( $def['label'] ); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
							<?php endif; ?>
							<tbody>
								<?php foreach ( $rt_rows as $row ) : ?>
									<tr>
										<?php foreach ( $rt_cols as $ci => $def ) : ?>
											<td<?php echo 0 === $ci ? ' class="japan-reqtable__pathway"' : ''; ?>><?php echo esc_html( ! empty( $row[ $def['cell'] ] ) ? $row[ $def['cell'] ] : '' ); ?></td>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Minimum legal requirements vs employer preferences -->

		<?php
	endif;
endif;
?>

<?php
/**
 * Flexible content sections (repeater) — rendered right after the table.
 * Each row is an "image (optional) + heading + rich text" block, so the client
 * can add as many sections as they need (e.g. "Typical Monthly Pay Ranges",
 * "Annual Salary Expectations", "ALT Salary in Japan"…). Reuses the .japan-block
 * styling. Empty rows and pages with no rows stay hidden.
 */
$section_items = get_field( 'japan_sections' );

if ( $section_items ) :

	foreach ( $section_items as $item ) :

		$s_image   = ! empty( $item['image'] ) ? $item['image'] : '';
		$s_heading = ! empty( $item['heading'] ) ? $item['heading'] : '';
		$s_content = ! empty( $item['content'] ) ? $item['content'] : '';

		if ( ! ( $s_image || $s_heading || $s_content ) ) {
			continue;
		}
		?>

		<!-- japan_sections item -->
		<section class="japan-block japan-block--section">
			<div class="ast-container">

				<?php if ( $s_image ) : ?>
					<div class="japan-block__media">
						<img src="<?php echo esc_url( $s_image ); ?>" alt="<?php echo esc_attr( $s_heading ); ?>" loading="lazy" />
					</div>
				<?php endif; ?>

				<?php if ( $s_heading ) : ?>
					<h2 class="japan-block__heading"><?php echo esc_html( $s_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $s_content ) : ?>
					<div class="japan-block__content"><?php echo wp_kses_post( $s_content ); ?></div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /japan_sections item -->

		<?php
	endforeach;
endif;
?>

<?php
// Second content table (same behaviour as the comparison table above) — rendered
// after the flexible content sections. Used e.g. for the "TEFL Institute Japan
// Opportunity Score" table. Hidden when empty; empty columns are dropped so a
// 2-5 column table renders cleanly.
$table2 = get_field( 'japan_table2' );

if ( $table2 ) :

	$t2_heading  = ! empty( $table2['heading'] ) ? $table2['heading'] : '';
	$t2_rows     = ! empty( $table2['rows'] ) ? $table2['rows'] : array();

	$t2_col_defs = array(
		array( 'label' => ! empty( $table2['col1_label'] ) ? $table2['col1_label'] : '', 'cell' => 'c1' ),
		array( 'label' => ! empty( $table2['col2_label'] ) ? $table2['col2_label'] : '', 'cell' => 'c2' ),
		array( 'label' => ! empty( $table2['col3_label'] ) ? $table2['col3_label'] : '', 'cell' => 'c3' ),
		array( 'label' => ! empty( $table2['col4_label'] ) ? $table2['col4_label'] : '', 'cell' => 'c4' ),
		array( 'label' => ! empty( $table2['col5_label'] ) ? $table2['col5_label'] : '', 'cell' => 'c5' ),
	);

	// Keep only columns that carry content (header label or a value in any row).
	$t2_cols = array();
	foreach ( $t2_col_defs as $def ) {
		$has_value = ( '' !== $def['label'] );
		if ( ! $has_value ) {
			foreach ( $t2_rows as $row ) {
				if ( ! empty( $row[ $def['cell'] ] ) ) {
					$has_value = true;
					break;
				}
			}
		}
		if ( $has_value ) {
			$t2_cols[] = $def;
		}
	}

	$t2_has_cols = false;
	foreach ( $t2_cols as $def ) {
		if ( '' !== $def['label'] ) {
			$t2_has_cols = true;
			break;
		}
	}

	if ( $t2_heading || ( $t2_rows && $t2_cols ) ) :
		?>

		<!-- Second content table -->
		<section class="japan-reqtable japan-reqtable--2">
			<div class="ast-container">

				<?php if ( $t2_heading ) : ?>
					<h2 class="japan-reqtable__heading"><?php echo esc_html( $t2_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $t2_rows ) && ! empty( $t2_cols ) ) : ?>
					<div class="japan-reqtable__wrap">
						<table class="japan-reqtable__table">
							<?php if ( $t2_has_cols ) : ?>
								<thead>
									<tr>
										<?php foreach ( $t2_cols as $def ) : ?>
											<th><?php echo esc_html( $def['label'] ); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
							<?php endif; ?>
							<tbody>
								<?php foreach ( $t2_rows as $row ) : ?>
									<tr>
										<?php foreach ( $t2_cols as $ci => $def ) : ?>
											<td<?php echo 0 === $ci ? ' class="japan-reqtable__pathway"' : ''; ?>><?php echo esc_html( ! empty( $row[ $def['cell'] ] ) ? $row[ $def['cell'] ] : '' ); ?></td>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Second content table -->

		<?php
	endif;
endif;
?>

<?php
/**
 * Degree requirements / TEFL requirements / Japanese language.
 * Three stacked "image (optional) + heading + rich text" blocks, rendered in
 * design order right after the comparison table. Each block only appears when
 * it has content, so unused blocks (and other pages sharing this template)
 * stay hidden.
 */
$japan_blocks = array(
	'japan_degree'     => 'japan-block--degree',
	'japan_tefl'       => 'japan-block--tefl',
	'japan_language'   => 'japan-block--language',
	'japan_experience' => 'japan-block--experience',
);

foreach ( $japan_blocks as $block_key => $block_mod ) :

	$blk = get_field( $block_key );

	if ( ! $blk ) {
		continue;
	}

	$blk_image   = ! empty( $blk['image'] ) ? $blk['image'] : '';
	$blk_heading = ! empty( $blk['heading'] ) ? $blk['heading'] : '';
	$blk_content = ! empty( $blk['content'] ) ? $blk['content'] : '';

	if ( ! ( $blk_image || $blk_heading || $blk_content ) ) {
		continue;
	}
	?>

	<!-- <?php echo esc_html( $block_key ); ?> -->
	<section class="japan-block <?php echo esc_attr( $block_mod ); ?>">
		<div class="ast-container">

			<?php if ( $blk_image ) : ?>
				<div class="japan-block__media">
					<img src="<?php echo esc_url( $blk_image ); ?>" alt="<?php echo esc_attr( $blk_heading ); ?>" loading="lazy" />
				</div>
			<?php endif; ?>

			<?php if ( $blk_heading ) : ?>
				<h2 class="japan-block__heading"><?php echo esc_html( $blk_heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $blk_content ) : ?>
				<div class="japan-block__content"><?php echo wp_kses_post( $blk_content ); ?></div>
			<?php endif; ?>

		</div>
	</section>
	<!-- /<?php echo esc_html( $block_key ); ?> -->

	<?php
endforeach;
?>

<?php
// All content is managed from the "Japan Page Fields > Japan Facts" ACF group.
$facts = get_field( 'japan_facts' );

if ( $facts ) :

	$f_heading = ! empty( $facts['heading'] ) ? $facts['heading'] : '';
	$f_cards   = ! empty( $facts['cards'] ) ? $facts['cards'] : array();
	$f_note    = ! empty( $facts['editor_note'] ) ? $facts['editor_note'] : '';

	if ( $f_heading || $f_cards || $f_note ) :
		?>

		<!-- Japan Facts -->
		<section class="japan-facts">
			<div class="ast-container">

				<?php if ( $f_heading ) : ?>
					<h2 class="japan-facts__heading"><?php echo esc_html( $f_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $f_cards ) ) : ?>
					<div class="japan-facts__grid">
						<?php foreach ( $f_cards as $card ) : ?>
							<div class="japan-facts__card">
								<?php if ( ! empty( $card['icon'] ) ) : ?>
									<span class="japan-facts__icon" aria-hidden="true">
										<img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" loading="lazy" />
									</span>
								<?php endif; ?>
								<?php if ( ! empty( $card['text'] ) ) : ?>
									<p class="japan-facts__text"><?php echo esc_html( $card['text'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $f_note ) : ?>
					<div class="editor-note">
						<p class="japan-facts__note">
							<?php
							// Bold a leading "Label:" prefix (e.g. "Editor note:") if present.
							if ( strpos( $f_note, ':' ) !== false ) {
								list( $en_label, $en_rest ) = explode( ':', $f_note, 2 );
								echo '<strong>' . esc_html( $en_label ) . ':</strong>' . esc_html( $en_rest );
							} else {
								echo esc_html( $f_note );
							}
							?>
						</p>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Japan Facts -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Why Japan" ACF group.
$why = get_field( 'japan_why' );

if ( $why ) :

	$w_image   = ! empty( $why['image'] ) ? $why['image'] : '';
	$w_heading = ! empty( $why['heading'] ) ? $why['heading'] : '';
	$w_content = ! empty( $why['content'] ) ? $why['content'] : '';

	if ( $w_image || $w_heading || $w_content ) :
		?>

		<!-- Why Japan is popular -->
		<section class="japan-why">
			<div class="ast-container">

				<?php if ( $w_image ) : ?>
					<div class="japan-why__media">
						<img src="<?php echo esc_url( $w_image ); ?>" alt="<?php echo esc_attr( $w_heading ); ?>" loading="lazy" />
					</div>
				<?php endif; ?>

				<?php if ( $w_heading ) : ?>
					<h2 class="japan-why__heading"><?php echo esc_html( $w_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $w_content ) : ?>
					<div class="japan-why__content"><?php echo wp_kses_post( $w_content ); ?></div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Why Japan is popular -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Partner" ACF group.
$partner = get_field( 'japan_partner' );

if ( $partner ) :

	$p_person  = ! empty( $partner['person_image'] ) ? $partner['person_image'] : '';
	$p_heading = ! empty( $partner['heading'] ) ? $partner['heading'] : '';
	$p_content = ! empty( $partner['content'] ) ? $partner['content'] : '';
	$p_button  = ! empty( $partner['button'] ) ? $partner['button'] : array();

	if ( $p_heading || $p_content || ! empty( $p_button['title'] ) || $p_person ) :
		?>

		<!-- Interested in partnering with us? -->
		<section class="japan-partner">
			<div class="ast-container">
				<div class="japan-partner__card">

					<div class="japan-partner__content">

						<?php if ( $p_heading ) : ?>
							<h2 class="japan-partner__heading"><?php echo esc_html( $p_heading ); ?></h2>
						<?php endif; ?>

						<?php if ( $p_content ) : ?>
							<div class="japan-partner__text"><?php echo wp_kses_post( $p_content ); ?></div>
						<?php endif; ?>

						<?php if ( ! empty( $p_button['title'] ) ) : ?>
							<a class="japan-partner__btn" href="<?php echo esc_url( $p_button['url'] ); ?>"
								<?php echo ! empty( $p_button['target'] ) ? 'target="' . esc_attr( $p_button['target'] ) . '"' : ''; ?>>
								<span><?php echo esc_html( $p_button['title'] ); ?></span>
								<svg class="japan-partner__arrow" width="20" height="14" viewBox="0 0 20 14" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
									<path d="M13 1l6 6-6 6M19 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						<?php endif; ?>

					</div>

					<?php if ( $p_person ) : ?>
						<div class="japan-partner__figure">
							<img src="<?php echo esc_url( $p_person ); ?>" alt="" loading="lazy" />
						</div>
					<?php endif; ?>

				</div>
			</div>
		</section>
		<!-- /Interested in partnering with us? -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Job Types" ACF group.
$jobs = get_field( 'japan_jobs' );

if ( $jobs ) :

	$j_heading = ! empty( $jobs['heading'] ) ? $jobs['heading'] : '';
	$j_sub     = ! empty( $jobs['subheading'] ) ? $jobs['subheading'] : '';
	$j_intro   = ! empty( $jobs['intro'] ) ? $jobs['intro'] : '';
	$j_items   = ! empty( $jobs['items'] ) ? $jobs['items'] : array();

	if ( $j_heading || $j_sub || $j_intro || $j_items ) :
		?>

		<!-- Job types overview -->
		<section class="japan-jobs">
			<div class="ast-container">

				<?php if ( $j_heading ) : ?>
					<h2 class="japan-jobs__heading"><?php echo esc_html( $j_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $j_sub ) : ?>
					<h3 class="japan-jobs__subheading"><?php echo esc_html( $j_sub ); ?></h3>
				<?php endif; ?>

				<?php if ( $j_intro ) : ?>
					<p class="japan-jobs__intro"><?php echo esc_html( $j_intro ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $j_items ) ) : ?>
					<ol class="japan-jobs__list">
						<?php foreach ( $j_items as $i => $item ) : ?>
							<li class="japan-jobs__item">
								<span class="japan-jobs__num" aria-hidden="true"><?php echo esc_html( $i + 1 ); ?></span>
								<div class="japan-jobs__body">
									<?php if ( ! empty( $item['title'] ) ) : ?>
										<h4 class="japan-jobs__item-title"><?php echo esc_html( $item['title'] ); ?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $item['content'] ) ) : ?>
										<div class="japan-jobs__item-content"><?php echo wp_kses_post( $item['content'] ); ?></div>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ol>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Job types overview -->

		<?php
	endif;
endif;
?>

<?php
// Flexible content sections (repeater) — rendered right after the Job Types
// section. Same "image (optional) + heading + rich text" rows as the first
// Content Sections block. Empty rows and pages with no rows stay hidden.
$job_sections = get_field( 'japan_sections2' );

if ( $job_sections ) :

	foreach ( $job_sections as $item ) :

		$js_image   = ! empty( $item['image'] ) ? $item['image'] : '';
		$js_heading = ! empty( $item['heading'] ) ? $item['heading'] : '';
		$js_content = ! empty( $item['content'] ) ? $item['content'] : '';

		if ( ! ( $js_image || $js_heading || $js_content ) ) {
			continue;
		}
		?>

		<!-- japan_sections2 item -->
		<section class="japan-block japan-block--section">
			<div class="ast-container">

				<?php if ( $js_image ) : ?>
					<div class="japan-block__media">
						<img src="<?php echo esc_url( $js_image ); ?>" alt="<?php echo esc_attr( $js_heading ); ?>" loading="lazy" />
					</div>
				<?php endif; ?>

				<?php if ( $js_heading ) : ?>
					<h2 class="japan-block__heading"><?php echo esc_html( $js_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $js_content ) : ?>
					<div class="japan-block__content"><?php echo wp_kses_post( $js_content ); ?></div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /japan_sections2 item -->

		<?php
	endforeach;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Featured Jobs" ACF group.
$featured = get_field( 'japan_featured' );

if ( $featured ) :

	$fj_heading = ! empty( $featured['heading'] ) ? $featured['heading'] : '';
	$fj_jobs    = ! empty( $featured['jobs'] ) ? $featured['jobs'] : array();
	$fj_note    = ! empty( $featured['note'] ) ? $featured['note'] : '';

	if ( $fj_heading || $fj_jobs || $fj_note ) :
		?>

		<!-- Featured jobs in Japan -->
		<section class="japan-featured">
			<div class="ast-container">

				<?php if ( $fj_heading ) : ?>
					<h2 class="japan-featured__heading"><?php echo esc_html( $fj_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $fj_jobs ) ) : ?>
					<div class="japan-featured__grid">
						<?php foreach ( $fj_jobs as $job ) : ?>
							<div class="japan-featured__card">
								<?php if ( ! empty( $job['link'] ) ) : ?>
									<a class="japan-featured__card-link" href="<?php echo esc_url( $job['link'] ); ?>" aria-label="<?php echo esc_attr( $job['title'] ); ?>"></a>
								<?php endif; ?>
								<?php if ( ! empty( $job['title'] ) ) : ?>
									<h3 class="japan-featured__card-title"><?php echo esc_html( $job['title'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $job['description'] ) ) : ?>
									<p class="japan-featured__card-desc"><?php echo esc_html( $job['description'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $fj_note ) : ?>
					<div class="editor-note">
						<p class="japan-featured__note"><?php echo esc_html( $fj_note ); ?></p>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Featured jobs in Japan -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Requirements" ACF group.
$req = get_field( 'japan_requirements' );

if ( $req ) :

	$rq_image     = ! empty( $req['image'] ) ? $req['image'] : '';
	$rq_heading   = ! empty( $req['heading'] ) ? $req['heading'] : '';
	$rq_content   = ! empty( $req['content'] ) ? $req['content'] : '';
	$rq_ch_head   = ! empty( $req['checklist_heading'] ) ? $req['checklist_heading'] : '';
	$rq_checklist = ! empty( $req['checklist'] ) ? $req['checklist'] : array();

	if ( $rq_image || $rq_heading || $rq_content || $rq_checklist ) :
		?>

		<!-- What do you need to teach English in Japan? -->
		<section class="japan-req">
			<div class="ast-container">

				<?php if ( $rq_image ) : ?>
					<div class="japan-req__media">
						<img src="<?php echo esc_url( $rq_image ); ?>" alt="<?php echo esc_attr( $rq_heading ); ?>" loading="lazy" />
					</div>
				<?php endif; ?>

				<?php if ( $rq_heading ) : ?>
					<h2 class="japan-req__heading"><?php echo esc_html( $rq_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $rq_content ) : ?>
					<div class="japan-req__content"><?php echo wp_kses_post( $rq_content ); ?></div>
				<?php endif; ?>

				<?php if ( $rq_ch_head ) : ?>
					<h3 class="japan-req__checklist-heading"><?php echo esc_html( $rq_ch_head ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $rq_checklist ) ) : ?>
					<ul class="japan-req__checklist">
						<?php foreach ( $rq_checklist as $item ) : ?>
							<li class="japan-req__item">
								<?php if ( ! empty( $item['icon'] ) ) : ?>
									<span class="japan-req__icon" aria-hidden="true">
										<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="" loading="lazy" />
									</span>
								<?php endif; ?>
								<?php if ( ! empty( $item['text'] ) ) : ?>
									<span class="japan-req__text"><?php echo esc_html( $item['text'] ); ?></span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>
		</section>
		<!-- /What do you need to teach English in Japan? -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Placements" ACF group.
$place = get_field( 'japan_placements' );

if ( $place ) :

	$pl_heading = ! empty( $place['heading'] ) ? $place['heading'] : '';
	$pl_cities  = ! empty( $place['cities'] ) ? $place['cities'] : array();

	// Build a clean data set for the front-end switcher; the first city is also
	// rendered server-side as the default view.
	$pl_data = array();
	foreach ( $pl_cities as $city ) {
		// Skip city rows that have no meaningful content.
		if ( empty( $city['map_image'] ) && empty( $city['card_photo'] ) && empty( $city['card_title'] )
			&& empty( $city['panel_title'] ) && empty( $city['panel_content'] ) ) {
			continue;
		}
		$pl_data[] = array(
			'map'           => ! empty( $city['map_image'] ) ? esc_url_raw( $city['map_image'] ) : '',
			'photo'         => ! empty( $city['card_photo'] ) ? esc_url_raw( $city['card_photo'] ) : '',
			'card_title'    => ! empty( $city['card_title'] ) ? $city['card_title'] : '',
			'card_text'     => ! empty( $city['card_text'] ) ? $city['card_text'] : '',
			'panel_title'   => ! empty( $city['panel_title'] ) ? $city['panel_title'] : '',
			'panel_content' => ! empty( $city['panel_content'] ) ? $city['panel_content'] : '',
		);
	}

	if ( ! empty( $pl_data ) ) :

		$first    = $pl_data[0];
		$multiple = count( $pl_data ) > 1;
		?>

		<!-- Japan Placements -->
		<section class="japan-place"<?php echo $multiple ? ' data-place-switch="1"' : ''; ?>>
			<div class="ast-container">

				<?php if ( $pl_heading ) : ?>
					<h2 class="japan-place__heading"><?php echo esc_html( $pl_heading ); ?></h2>
				<?php endif; ?>

				<div class="japan-place__inner">

					<div class="japan-place__map">

						<img class="japan-place__map-img" src="<?php echo esc_url( $first['map'] ); ?>" alt="<?php echo esc_attr( $first['panel_title'] ? $first['panel_title'] : 'Japan placements map' ); ?>" loading="lazy" />

						<div class="japan-place__card">
							<div class="japan-place__card-photo">
								<img src="<?php echo esc_url( $first['photo'] ); ?>" alt="<?php echo esc_attr( $first['card_title'] ); ?>" loading="lazy" />
								<?php if ( $multiple ) : ?>
									<button type="button" class="japan-place__nav japan-place__nav--prev" aria-label="Previous city">
										<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1 1 7l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
									</button>
									<button type="button" class="japan-place__nav japan-place__nav--next" aria-label="Next city">
										<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m1 1 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
									</button>
								<?php endif; ?>
							</div>
							<div class="japan-place__card-body">
								<h3 class="japan-place__card-title"><?php echo esc_html( $first['card_title'] ); ?></h3>
								<p class="japan-place__card-text"><?php echo esc_html( $first['card_text'] ); ?></p>
							</div>
						</div>

					</div>

					<div class="japan-place__panel">
						<h3 class="japan-place__panel-title"><?php echo esc_html( $first['panel_title'] ); ?></h3>
						<div class="japan-place__panel-content"><?php echo wp_kses_post( $first['panel_content'] ); ?></div>
					</div>

				</div>

				<?php if ( $multiple ) : ?>
					<script type="application/json" class="japan-place__data"><?php echo wp_json_encode( $pl_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Japan Placements -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Salary" ACF group.
$salary = get_field( 'japan_salary' );

if ( $salary ) :

	$sl_heading = ! empty( $salary['heading'] ) ? $salary['heading'] : '';
	$sl_content = ! empty( $salary['content'] ) ? $salary['content'] : '';
	$sl_col1    = ! empty( $salary['col1_label'] ) ? $salary['col1_label'] : '';
	$sl_col2    = ! empty( $salary['col2_label'] ) ? $salary['col2_label'] : '';
	$sl_rows    = ! empty( $salary['rows'] ) ? $salary['rows'] : array();

	if ( $sl_heading || $sl_content || $sl_rows ) :
		?>

		<!-- How much do English teachers make in Japan? -->
		<section class="japan-salary">
			<div class="ast-container">

				<?php if ( $sl_heading ) : ?>
					<h2 class="japan-salary__heading"><?php echo esc_html( $sl_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $sl_content ) : ?>
					<div class="japan-salary__content"><?php echo wp_kses_post( $sl_content ); ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $sl_rows ) ) : ?>
					<div class="japan-salary__table-wrap">
						<table class="japan-salary__table">
							<?php if ( $sl_col1 || $sl_col2 ) : ?>
								<thead>
									<tr>
										<th><?php echo esc_html( $sl_col1 ); ?></th>
										<th><?php echo esc_html( $sl_col2 ); ?></th>
									</tr>
								</thead>
							<?php endif; ?>
							<tbody>
								<?php foreach ( $sl_rows as $row ) : ?>
									<tr>
										<td class="japan-salary__route"><?php echo esc_html( ! empty( $row['route'] ) ? $row['route'] : '' ); ?></td>
										<td class="japan-salary__framing"><?php echo esc_html( ! empty( $row['framing'] ) ? $row['framing'] : '' ); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /How much do English teachers make in Japan? -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Visa" ACF group.
$visa = get_field( 'japan_visa' );

if ( $visa ) :

	$vs_image     = ! empty( $visa['image'] ) ? $visa['image'] : '';
	$vs_heading   = ! empty( $visa['heading'] ) ? $visa['heading'] : '';
	$vs_content   = ! empty( $visa['content'] ) ? $visa['content'] : '';
	$vs_list_head = ! empty( $visa['list_heading'] ) ? $visa['list_heading'] : '';
	$vs_list      = ! empty( $visa['list'] ) ? $visa['list'] : array();

	if ( $vs_image || $vs_heading || $vs_content || $vs_list ) :
		?>

		<!-- Japan visa process for English teachers -->
		<section class="japan-visa">
			<div class="ast-container">

				<?php if ( $vs_image ) : ?>
					<div class="japan-visa__media">
						<img src="<?php echo esc_url( $vs_image ); ?>" alt="<?php echo esc_attr( $vs_heading ); ?>" loading="lazy" />
					</div>
				<?php endif; ?>

				<?php if ( $vs_heading ) : ?>
					<h2 class="japan-visa__heading"><?php echo esc_html( $vs_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $vs_content ) : ?>
					<div class="japan-visa__content"><?php echo wp_kses_post( $vs_content ); ?></div>
				<?php endif; ?>

				<?php if ( $vs_list_head ) : ?>
					<h3 class="japan-visa__list-heading"><?php echo esc_html( $vs_list_head ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $vs_list ) ) : ?>
					<ul class="japan-visa__list">
						<?php foreach ( $vs_list as $item ) : ?>
							<?php if ( ! empty( $item['text'] ) ) : ?>
								<li class="japan-visa__item"><?php echo esc_html( $item['text'] ); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Japan visa process for English teachers -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Best Route" ACF group.
$route = get_field( 'japan_route' );

if ( $route ) :

	$rt_heading = ! empty( $route['heading'] ) ? $route['heading'] : '';
	$rt_sub     = ! empty( $route['subheading'] ) ? $route['subheading'] : '';
	$rt_intro   = ! empty( $route['intro'] ) ? $route['intro'] : '';
	$rt_cards   = ! empty( $route['cards'] ) ? $route['cards'] : array();

	if ( $rt_heading || $rt_sub || $rt_intro || $rt_cards ) :
		?>

		<!-- Best route for you -->
		<section class="japan-route">
			<div class="ast-container">

				<?php if ( $rt_heading ) : ?>
					<h2 class="japan-route__heading"><?php echo esc_html( $rt_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $rt_sub ) : ?>
					<h3 class="japan-route__subheading"><?php echo esc_html( $rt_sub ); ?></h3>
				<?php endif; ?>

				<?php if ( $rt_intro ) : ?>
					<p class="japan-route__intro"><?php echo esc_html( $rt_intro ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $rt_cards ) ) : ?>
					<div class="japan-route__grid">
						<?php foreach ( $rt_cards as $card ) : ?>
							<div class="japan-route__card">
								<div class="japan-route__card-head">
									<?php if ( ! empty( $card['title'] ) ) : ?>
										<h4 class="japan-route__card-title"><?php echo esc_html( $card['title'] ); ?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $card['image'] ) ) : ?>
										<span class="japan-route__card-img">
											<img src="<?php echo esc_url( $card['image'] ); ?>" alt="" loading="lazy" />
										</span>
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $card['description'] ) ) : ?>
									<div class="japan-route__card-body">
										<p class="japan-route__card-desc"><?php echo esc_html( $card['description'] ); ?></p>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Best route for you -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Courses" ACF group.
$courses = get_field( 'japan_courses' );

if ( $courses ) :

	$co_heading = ! empty( $courses['heading'] ) ? $courses['heading'] : '';
	$co_items   = ! empty( $courses['courses'] ) ? $courses['courses'] : array();
	$co_note    = ! empty( $courses['note'] ) ? $courses['note'] : '';

	if ( $co_heading || $co_items || $co_note ) :
		?>

		<!-- Best TEFL courses for teaching in Japan -->
		<section class="japan-courses">
			<div class="ast-container">

				<?php if ( $co_heading ) : ?>
					<h2 class="japan-courses__heading"><?php echo esc_html( $co_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $co_items ) ) : ?>
					<div class="japan-courses__grid">
						<?php foreach ( $co_items as $course ) : ?>
							<div class="japan-courses__card">
								<?php if ( ! empty( $course['link'] ) ) : ?>
									<a class="japan-courses__card-link" href="<?php echo esc_url( $course['link'] ); ?>" aria-label="<?php echo esc_attr( $course['title'] ); ?>"></a>
								<?php endif; ?>
								<?php if ( ! empty( $course['title'] ) ) : ?>
									<h3 class="japan-courses__card-title"><?php echo esc_html( $course['title'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $course['description'] ) ) : ?>
									<p class="japan-courses__card-desc"><?php echo esc_html( $course['description'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $co_note ) : ?>
					<div class="editor-note">
						<p class="japan-courses__note"><?php echo esc_html( $co_note ); ?></p>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Best TEFL courses for teaching in Japan -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Blogs" ACF group.
// The cards pull their image, category (tag) and title from the selected posts.
$blogs = get_field( 'japan_blogs' );

if ( $blogs ) :

	$bl_heading = ! empty( $blogs['heading'] ) ? $blogs['heading'] : '';
	$bl_posts   = ! empty( $blogs['posts'] ) ? array_values( (array) $blogs['posts'] ) : array();

	if ( $bl_heading || $bl_posts ) :

		// Renders one blog card from a post ID. $size is big | small | wide.
		$japan_blog_card = function ( $pid, $size ) {
			if ( ! $pid || 'publish' !== get_post_status( $pid ) ) {
				return;
			}
			$img   = get_the_post_thumbnail_url( $pid, 'large' );
			$terms = get_the_category( $pid );
			$cat   = ! empty( $terms ) ? $terms[0]->name : '';
			?>
			<a class="japan-blogs__card japan-blogs__card--<?php echo esc_attr( $size ); ?>" href="<?php echo esc_url( get_permalink( $pid ) ); ?>">
				<?php if ( $img ) : ?>
					<img class="japan-blogs__card-img" src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title( $pid ) ); ?>" loading="lazy" />
				<?php endif; ?>
				<span class="japan-blogs__card-body">
					<?php if ( $cat ) : ?>
						<span class="japan-blogs__card-cat"><?php echo esc_html( $cat ); ?></span>
					<?php endif; ?>
					<span class="japan-blogs__card-title"><?php echo esc_html( get_the_title( $pid ) ); ?></span>
				</span>
			</a>
			<?php
		};
		?>

		<!-- Read more about Japan teaching -->
		<section class="japan-blogs">
			<div class="ast-container">

				<?php if ( $bl_heading ) : ?>
					<h2 class="japan-blogs__heading"><?php echo esc_html( $bl_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $bl_posts ) ) : ?>
					<div class="japan-blogs__grid">
						<div class="japan-blogs__top">
							<?php $japan_blog_card( isset( $bl_posts[0] ) ? $bl_posts[0] : 0, 'big' ); ?>
							<div class="japan-blogs__stack">
								<?php $japan_blog_card( isset( $bl_posts[1] ) ? $bl_posts[1] : 0, 'small' ); ?>
								<?php $japan_blog_card( isset( $bl_posts[2] ) ? $bl_posts[2] : 0, 'small' ); ?>
							</div>
						</div>
						<div class="japan-blogs__bottom">
							<?php $japan_blog_card( isset( $bl_posts[3] ) ? $bl_posts[3] : 0, 'wide' ); ?>
							<?php $japan_blog_card( isset( $bl_posts[4] ) ? $bl_posts[4] : 0, 'wide' ); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Read more about Japan teaching -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > FAQs" ACF group.
$faq = get_field( 'japan_faq' );

if ( $faq ) :

	$fq_heading = ! empty( $faq['heading'] ) ? $faq['heading'] : '';
	$fq_items   = ! empty( $faq['items'] ) ? $faq['items'] : array();

	if ( $fq_heading || $fq_items ) :
		?>

		<!-- FAQs about teaching in Japan -->
		<section class="japan-faq">
			<div class="ast-container">

				<?php if ( $fq_heading ) : ?>
					<h2 class="japan-faq__heading"><?php echo esc_html( $fq_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $fq_items ) ) : ?>
					<div class="japan-faq__list">
						<?php foreach ( $fq_items as $i => $item ) : ?>
							<?php if ( ! empty( $item['question'] ) ) : ?>
								<details class="japan-faq__item" name="japan-faq"<?php echo 0 === $i ? ' open' : ''; ?>>
									<summary class="japan-faq__q"><?php echo esc_html( $item['question'] ); ?></summary>
									<?php if ( ! empty( $item['answer'] ) ) : ?>
										<div class="japan-faq__a"><?php echo wp_kses_post( $item['answer'] ); ?></div>
									<?php endif; ?>
								</details>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<script>
					( function () {
						var items = document.querySelectorAll( '.japan-faq__item' );
						items.forEach( function ( d ) {
							d.addEventListener( 'toggle', function () {
								if ( d.open ) {
									items.forEach( function ( o ) {
										if ( o !== d ) { o.open = false; }
									} );
								}
							} );
						} );
					} )();
					</script>
				<?php endif; ?>

			</div>
		</section>
		<!-- /FAQs about teaching in Japan -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Sources" ACF group.
$sources = get_field( 'japan_sources' );

if ( $sources ) :

	$sr_heading     = ! empty( $sources['heading'] ) ? $sources['heading'] : '';
	$sr_content     = ! empty( $sources['content'] ) ? $sources['content'] : '';
	$sr_box_heading = ! empty( $sources['box_heading'] ) ? $sources['box_heading'] : '';
	$sr_list        = ! empty( $sources['sources'] ) ? $sources['sources'] : array();

	if ( $sr_heading || $sr_content || $sr_list ) :
		?>

		<!-- Sources and methodology -->
		<section class="japan-sources">
			<div class="ast-container">

				<?php if ( $sr_heading ) : ?>
					<h2 class="japan-sources__heading"><?php echo esc_html( $sr_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $sr_content ) : ?>
					<div class="japan-sources__content"><?php echo wp_kses_post( $sr_content ); ?></div>
				<?php endif; ?>

				<?php if ( $sr_box_heading || $sr_list ) : ?>
					<div class="japan-sources__box">
						<?php if ( $sr_box_heading ) : ?>
							<h3 class="japan-sources__box-heading"><?php echo esc_html( $sr_box_heading ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $sr_list ) ) : ?>
							<ul class="japan-sources__list">
								<?php foreach ( $sr_list as $item ) : ?>
									<?php if ( ! empty( $item['text'] ) ) : ?>
										<li class="japan-sources__item"><?php echo wp_kses_post( $item['text'] ); ?></li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Sources and methodology -->

		<?php
	endif;
endif;
?>

<?php
// All content is managed from the "Japan Page Fields > Partner Form" ACF group.
$pform = get_field( 'japan_partner_form' );

if ( $pform ) :

	$pf_heading   = ! empty( $pform['heading'] ) ? $pform['heading'] : '';
	$pf_sub       = ! empty( $pform['subheading'] ) ? $pform['subheading'] : '';
	$pf_shortcode = ! empty( $pform['form_shortcode'] ) ? $pform['form_shortcode'] : '';

	if ( $pf_heading || $pf_sub || $pf_shortcode ) :
		?>

		<!-- Become a Partner Today -->
		<section class="japan-pform">
			<div class="ast-container">

				<?php if ( $pf_heading ) : ?>
					<h2 class="japan-pform__heading"><?php echo esc_html( $pf_heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $pf_sub ) : ?>
					<p class="japan-pform__sub"><?php echo esc_html( $pf_sub ); ?></p>
				<?php endif; ?>

				<?php if ( $pf_shortcode ) : ?>
					<div class="japan-pform__card">
						<?php echo do_shortcode( $pf_shortcode ); ?>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<!-- /Become a Partner Today -->

		<?php
	endif;
endif;
?>

<?php get_footer(); ?>
