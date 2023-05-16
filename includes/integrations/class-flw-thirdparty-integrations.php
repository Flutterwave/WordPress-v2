<?php
/*
 * Flutterwave Integrations.
 *
 * @package Flutterwave_Payments
 * @version 1.0.6
 */

use Flutterwave\WordPress\Integration\AbstractService;

class FLW_Thirdparty_Integrations {

	public static array $integrations = array();

	public static ?FLW_Thirdparty_Integrations $instance = null;

	private function __construct() {
		add_action( 'admin_menu', array( $this, '_add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'get_admin_script' ) );
		$this->init_settings();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Registers admin setting
	 *
	 * @return void
	 */
	public function register_settings() {

		register_setting( 'flw-itegration-group', 'flw_integrations_options' );

	}

	private function init_settings() {

		if ( false == get_option( 'flw_integrations_options' ) ) {
			update_option( 'flw_integrations_options', array() );
		}

	}

	public static function register( array $services = array() ) {

		foreach ( $services as $service ) {
			$service = new $service( 'YOUR-API-KEY' );
			if ( ! $service instanceof AbstractService ) {
				continue;
			} else {
				$owner = $service->get_info()['owner'];
				$name  = $service->get_info()['name'];

				$default_values = array(
					'name'      => ucfirst( $name ),
					'developer' => ucfirst( $owner ),
					'key'       => $service->get_key(),
				);

				add_option( 'flw_integration_' . $owner . '_' . $name, $default_values );

				if ( ! isset( self::$integrations[ $owner ][ $name ] ) ) {

					self::$integrations[ $owner ] = array( $name => $service );

				} else {

					self::$integrations[ $owner ][ $name ] = $service;

				}
			}
		}
	}

	public function get( string $service_name ): ?AbstractService {

		if ( ! isset( self::$integrations[ $service_name ] ) ) {
			return null;
		}

		return self::$integrations[ $service_name ];
	}

	/**
	 * Fetches admin option settings from the db.
	 *
	 * @param $attr
	 *
	 * @return mixed           The value of the option fetched.
	 */
	public function get_option_value( $attr ) {

		$options = get_option( 'flw_rave_options' );

		if ( array_key_exists( $attr, $options ) ) {

			return $options[ $attr ];

		}

		return '';
	}

	public function get_admin_script() {
		wp_enqueue_style( 'flw-integration-css', FLW_DIR_URL . 'assets/css/admin/integrations.css', array(), FLW_PAY_VERSION, false );
		wp_enqueue_style( 'flw-integration-css' );
		wp_enqueue_script( 'flw-intergration-js', FLW_DIR_URL . 'assets/js/admin/integrations.js', array( 'jquery' ), FLW_PAY_VERSION, false );

	}

	/**
	 * Add admin menu
	 *
	 * @return void
	 */
	public function _add_admin_menu() {
		add_submenu_page(
			'flutterwave-payments',
			__( 'Flutterwave Payments Integrations', 'flutterwave-payments' ),
			__( 'Integrations', 'flutterwave-payments' ),
			'manage_options',
			'flutterwave-payments-integrations',
			array( __CLASS__, 'flw_integration_page' )
		);
	}

	/**
	 * Admin Integration page content
	 *
	 * @return void
	 */
	public static function flw_integration_page() {

		$integrations = self::$integrations;

		include_once dirname( FLW_PAY_PLUGIN_FILE ) . '/views/admin-integrations-page.php';

	}

}
