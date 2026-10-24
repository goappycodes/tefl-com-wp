<?php
/**
 * Footer Layout 5
 *
 * @package Astra Addon
 * @since   Astra 1.0.12
 */

/**
 * Hide advanced footer markup if:
 *
 * - User is not logged in. [AND]
 * - All widgets are not active.
 */
if ( ! is_user_logged_in() ) {
	if (
		! is_active_sidebar( 'advanced-footer-widget-1' ) &&
		! is_active_sidebar( 'advanced-footer-widget-2' ) &&
		! is_active_sidebar( 'advanced-footer-widget-3' ) &&
		! is_active_sidebar( 'advanced-footer-widget-4' ) &&
		! is_active_sidebar( 'advanced-footer-widget-5' )
	) {
		return;
	}
}

$classes[] = 'footer-adv';
$classes[] = 'footer-adv-layout-5';
$classes   = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<div class="footer-adv-overlay footer-new">
		<div class="ast-container">
			<div class="ast-row">
				<div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-1" <?php echo wp_kses_post( apply_filters( 'astra_sidebar_data_attrs', '', 'advanced-footer-widget-1' ) ); ?>>
					<?php astra_get_footer_widget( 'advanced-footer-widget-1' ); ?>
				</div>
				<div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-3" <?php echo wp_kses_post( apply_filters( 'astra_sidebar_data_attrs', '', 'advanced-footer-widget-3' ) ); ?>>
					<?php astra_get_footer_widget( 'advanced-footer-widget-3' ); ?>
				</div>
				<div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-4" <?php echo wp_kses_post( apply_filters( 'astra_sidebar_data_attrs', '', 'advanced-footer-widget-4' ) ); ?>>
					<?php astra_get_footer_widget( 'advanced-footer-widget-4' ); ?>
				</div>
				<div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 footer-adv-widget footer-adv-widget-2" <?php echo wp_kses_post( apply_filters( 'astra_sidebar_data_attrs', '', 'advanced-footer-widget-2' ) ); ?>>
					<?php astra_get_footer_widget( 'advanced-footer-widget-2' ); ?>
				</div>
				
			</div>
			<div class="spacer-column"></div>
			<div class="ast-row">
				<div class="ast-col-md-3">
					<div class="site-social-logo-container">
						<a href="/"><?php
							// Standard logo (cache-safe); ti-global.js updateLogo() swaps in the visitor's city logo.
							$site_logo = '/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg'; ?>
							<img src="<?php echo !empty($site_logo)? $site_logo: '/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg'?>" alt="TEFL Institute" class="site-logo">
						</a>
						<div class="social-icons-container">
							<a href="https://www.facebook.com/theteflinstitute/" target="_blank">
								<i class="fa fa-facebook social-icon" ></i>
							</a>
							<a href="https://www.instagram.com/theteflinstitute" target="_blank">
								<i class="fa fa-instagram social-icon"></i>
							</a>
							<a href="https://twitter.com/teflinstitute_" target="_blank">
								<i class="fa fa-twitter social-icon"></i>
							</a>
							<a href="https://www.linkedin.com/school/the-tefl-institute-ltd/" target="_blank">
								<i class="fa fa-linkedin social-icon"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="mobile-two-column ast-col-md-12">
                  <div class="ast-col-md-4 first-col">
					<div class="accreditation-council-logo-container"> 
						<a target="_blank" href="https://find-a-qualification.services.ofqual.gov.uk/qualifications/61015714" rel="noopener">
							<img src="/wp-content/uploads/2021/10/Highfield-logo-white.svg" class="accreditation-council-logo" alt="Training Qualification">
						</a> 
						<p>Highfield<br>Approved Center Number<br>21335</p></div>
					</div>

					<div class="ast-col-md-3 second-col">
						<div class="accreditation-council-logo-container">
							<img src="/wp-content/uploads/2026/05/OTCAC-logo-white.png" class="accreditation-council-logo" alt="">
						</div>
					</div>
					
                   <div class="ast-col-md-5 third-col">
						<div class="accreditation-council-logo-container">
							<a target="_blank" href="https://www.aqcreview.org/providers/the-tefl-institute/">
								<img src="/wp-content/uploads/2024/03/footer-tefl-institute.png" class="accreditation-council-logo" alt="Accreditation Council">
							</a> 
							<p>DEAC/ACQ<br>Curriculum Approved Centre</p>
						</div>
					</div>
				</div>
				<div class="ast-col-md-3">
					<div class="payment-partners-logos">
						<img src="/wp-content/uploads/2023/05/payment-partners.svg" class="payment-partners-logo" alt="">
						<span>14 DAY MONEY BACK GUARANTEE</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>