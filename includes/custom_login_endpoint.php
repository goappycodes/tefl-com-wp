<?php

class WC_REST_Custom_Controller {

	protected $namespace = 'wc/v3';

	protected $rest_base = 'login';

	/**
	 * Shared secret so only the jobs site (jobs.teflinstitute.com) can call
	 * this endpoint. Overridable via a wp-config constant if ever needed.
	 */
	protected function expected_secret() {
		return defined( 'JOBS_BRIDGE_SECRET' )
			? JOBS_BRIDGE_SECRET
			: 'f3ef2116765a67fb9d4cda8dc5e5029aef5c874999e31df202ec8c97be02e66b';
	}

	/**
	 * Gate the endpoint on a shared-secret header (X-Jobs-Auth). Without a
	 * valid secret the route behaves as if it does not exist to callers.
	 */
	public function check_secret( $request ) {
		$provided = (string) $request->get_header( 'x_jobs_auth' );
		$expected = (string) $this->expected_secret();
		if ( '' === $provided || ! hash_equals( $expected, $provided ) ) {
			return new WP_Error( 'rest_forbidden', 'Forbidden', array( 'status' => 403 ) );
		}
		return true;
	}

	/**
	 * Validate credentials only. Returns just the user ID on success -- no
	 * user row, password hash or other fields are exposed.
	 */
	public function verify_user_login( $data ) {
		$email    = isset( $data['email'] ) ? $data['email'] : '';
		$password = isset( $data['password'] ) ? $data['password'] : '';

		// wp_authenticate validates the credentials without setting cookies.
		$user = wp_authenticate( $email, $password );

		if ( is_wp_error( $user ) || ! ( $user instanceof WP_User ) ) {
			return new WP_REST_Response( array( 'req' => array( 'success' => false ) ), 403 );
		}

		// Preserve the shape the jobs bridge reads: $response['req']['data']['ID'].
		return new WP_REST_Response(
			array( 'req' => array( 'data' => array( 'ID' => $user->ID ) ) ),
			200
		);
	}

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'verify_user_login' ),
				'permission_callback' => array( $this, 'check_secret' ),
			)
		);
	}
}

add_filter( 'woocommerce_rest_api_get_rest_namespaces', 'woo_custom_api' );

function woo_custom_api( $controllers ) {
	$controllers['wc/v3']['custom'] = 'WC_REST_Custom_Controller';

	return $controllers;
}
