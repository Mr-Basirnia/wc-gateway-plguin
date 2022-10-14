<?php

/**
 * Woocommerce Shipping Class
 *
 * @since 1.0.0
 */
class Woo_Shipping extends WC_Shipping_Method {
	public function __construct( $instance_id = 0 ) {
		parent::__construct( $instance_id );

		$this->id    = 'woo_shipping_plugin';
		$this->title = 'ارسال رایگان به تهران';
	}
}


add_action( 'woocommerce_shipping_init', function () {
	( new Woo_Shipping() );
} );