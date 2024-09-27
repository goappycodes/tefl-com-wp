<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<style>
  #primary {
      padding: 3rem 0;
  }

  .entry-header {
      display: none;
  }
  
  .woocommerce-form-row {
      padding: 0 !important;
      flex-direction: column;
      align-items: flex-start !important;
      margin-bottom: 20px !important;
  }

  label {
      width: auto !important;
      margin-bottom: 5px;
      font-weight: 400 !important;
  }
h4 {
    font-size: 18px !important;
    font-weight: 500 !important;
    line-height: 1.5 !important;
}
  .form-row {
      display: flex;
      flex-direction: inherit;
      align-items: flex-start !important;
  }

  .woocommerce form .form-row {
      padding: 0;
      margin: 0 0 20px 0;
  }

  label.woocommerce-form__label.woocommerce-form__label-for-checkbox.woocommerce-form-login__rememberme {}

  .woocommerce-form-login__rememberme {
      margin-bottom: 20px;
  }

  .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
      width: 100% !important;
  }

  .password-input {
      width: 100%;
  }
  
  body .woocommerce form.login {
    border: 0;
    padding: 0;
    border-radius: 0;
    margin: 0;
}
  
  .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
    color: #888 !important;
}
  
.u-column2 {
    display: none;
}

.u-column1 {
    float: none !important;
    width: 100% !important;
}
  
  
form.woocommerce-form.woocommerce-form-login>p {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

form.woocommerce-form.woocommerce-form-login>p label {
    width: 150px;
}

.woocommerce-form-login__submit {
    background: #333;
}    
.login-container {
    display: flex;
    flex-wrap: wrap;
}

.login-container>* {
    width: 50%;
    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;
    text-align: center;
  	padding-left: 3rem;
}

form.woocommerce-form.woocommerce-form-login>p {
    width: 100%;
    text-align: left;
}

.learner-login-inner {
    background: #F2F2F2;
    padding: 40px;
  	height: 100%;
}

@media (max-width:768px){
    .login-container {
        flex-direction: column;
    }
    
    .login-container>* {
        width: 100%;
    }
    
    h1.entry-title {
        margin: 20px auto;
    }
    
    form.woocommerce-form.woocommerce-form-login.login {
        order: 2;
    }
    
    .learner-login {
        margin: 20px auto 60px;
    }    
}
</style>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>


<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

        <div class="login-container">
		<form class="woocommerce-form woocommerce-form-login login" method="post">
            <h3 style="text-align: left; width: 100%;">My Account</h3>
          	<h4 style="text-align: left; width: 100%;">Login to view your purchases/ buy new courses/ study extensions/ pay your instalments.</h4>
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
        <div class="learner-login">
          <div class="learner-login-inner">
            <h2 class="login-box-header text-center"><img src="https://teflinstitute.com/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg" title="The TEFL Institute of Ireland" alt="The TEFL Institute of Ireland" style="height: 100px;"></h2>
            <h3>Student Login</h3>
              <h4 style="width: 100%;">Login here to access your course material, study your course.</h4>
            	<a class="button ptefl-button" href="https://courses.teflinstitute.com/login/index.php">Log in</a>
          </div>
        </div>
        </div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
