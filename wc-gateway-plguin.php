<?php
/*
Plugin Name: ووکامرس پرداخت
Plugin URI: https://github.com/Mr-Basirnia/wc-gateway-plguin
Description: پرداخت با پلاگین ووکامرس پرداخت
Version: 1.0.0
Author URI: https://github.com/Mr-Basirnia
*/


// Test to see if WooCommerce is active (including network activated).
$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';

if (
	in_array( $plugin_path, wp_get_active_and_valid_plugins() )
	|| in_array( $plugin_path, wp_get_active_network_plugins() )
) {
	add_action( 'plugins_loaded', function () {
		class Woo_Gateway extends WC_Payment_Gateway {
			public function __construct() {
				$this->id                 = 'woo_gateway';
				$this->method_title       = 'درگاه پرداخت تستی';
				$this->icon               = null;
				$this->has_fields         = false;
				$this->method_description = 'توضیحات درگاه';
				$this->init_form_fields();
			}

			public function init_form_fields() {
				$this->form_fields = array(
					'enabled'  => array(
						'title'   => 'فعال / غیرفعال',
						'type'    => 'checkbox',
						'label'   => 'فعال بودن درگاه پرداخت',
						'default' => 'no'
					),
					'merchant' => array(
						'title'       => 'Api درگاه پرداخت',
						'type'        => 'text',
						'description' => 'برای فعال سازی درگاه پرداخت، API رو وارد کنید'
					)
				);
			}
		}

		add_filter( 'woocommerce_payment_gateways', function ( array $methods ) {
			$methods[] = 'Woo_Gateway';

			return $methods;
		} );
	} );
}