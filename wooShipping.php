<?php

/**
 * Woocommerce Shipping Class
 *
 * @since 1.0.0
 */
class Woo_Shipping extends WC_Shipping_Method {
	public function __construct( $instance_id = 0 ) {
		parent::__construct( $instance_id );

		$this->id                 = 'woo_shipping_plugin';
		$this->title              = 'ارسال رایگان به تهران';
		$this->method_description = 'شیوه ارسال به شهرستان تهران';
		$this->enabled            = 'yes';

		$this->init_form_fields();
		$this->init_settings();

		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
	}

	/**
	 * initialize form fields
	 *
	 * @return void
	 */
	public function init_form_fields(): void {
		$this->form_fields = array(
			'enabled' => array(
				'title'   => 'فعال / غیرفعال',
				'type'    => 'checkbox',
				'default' => 'no'
			),
			'amount'  => array(
				'title' => 'حداکثر قیمت سفارش',
				'type'  => 'number'
			)
		);
	}
}


add_action( 'woocommerce_shipping_init', function () {
	( new Woo_Shipping() );
} );
add_action( 'woocommerce_shipping_methods', function ( array $methods ) {
	$methods['woo_shipping'] = 'Woo_Shipping';

	return $methods;
} );