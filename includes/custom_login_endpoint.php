<?php

class WC_REST_Custom_Controller {
	/**
	 * You can extend this class with
	 * WP_REST_Controller / WC_REST_Controller / WC_REST_Products_V2_Controller / WC_REST_CRUD_Controller etc.
	 * Found in packages/woocommerce-rest-api/src/Controllers/
	 */
	protected $namespace = 'wc/v3';

	protected $rest_base = 'login';

	public function verify_user_login( $data ) {

        // $creds = array(
        //     'user_login'    => $data['email'],
        //     'user_password' => $data['password'],
        //     'remember'      => false
        // );
     
        $user = wp_authenticate( $data['email'], $data['password'] );
     
        if ( is_wp_error( $user ) ) {
            $res = new WP_REST_Response($user);
            $res->set_status(403);
        } else {
            $res = $user;
            $res->set_status(200);
        }


        return ['req' => $res];
    }

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				'methods' => 'POST',
				'callback' => array( $this, 'verify_user_login' ),
                'permission_callback' => function($request){      
                    return true;
                }
			)
		);
	}
}



add_filter( 'woocommerce_rest_api_get_rest_namespaces', 'woo_custom_api' );

function woo_custom_api( $controllers ) {
	$controllers['wc/v3']['custom'] = 'WC_REST_Custom_Controller';

	return $controllers;
}