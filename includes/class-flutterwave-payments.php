<?php
/**
 * Flutterwave base class
 *
 * @package Flutterwave_Payments
 */

use Flutterwave\WordPress\API\Client;
use Flutterwave\WordPress\Integration\ApiLayer\ExchangeRateService;

defined( 'ABSPATH' ) || exit;

/**
 * Main Plugin Class
 */
final class Flutterwave_Payments {

	/**
	 * Plugin name
	 * Plugin name
	 *
	 * @var string $plugin_name
	 */
	private string $plugin_name = 'flutterwave-payments';
	/**
	 * Plugin version
	 *
	 * @var string $plugin_version
	 */
	private string $plugin_version = '1.0.6';

	/**
	 * Instance variable
	 *
	 * @var Flutterwave_Payments|null $instance
	 */
	protected static ?Flutterwave_Payments $instance = null;

	/**
	 * API Client
	 *
	 * @var Client $api_client
	 */
	protected Client $api_client;

	/**
	 * API Client
	 *
	 * @var object|null $settings
	 */
	private ?object $settings;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->define_constants();
		$this->include_files();
		$this->init();
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( string $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Define all constants.
	 *
	 * @return void
	 */
	private function define_constants() {
		$this->define( 'FLW_PAY_VERSION', $this->plugin_version );
		$this->define( 'FLW_DIR_PATH', plugin_dir_path( FLW_PAY_PLUGIN_FILE ) );
		$this->define( 'FLW_DIR_URL', plugin_dir_url( FLW_PAY_PLUGIN_FILE ) );
	}

	/**
	 * Includes all required files
	 *
	 * @return void
	 */
	private function include_files() {
		require_once FLW_DIR_PATH . 'includes/class-flw-admin-settings.php';
		require_once FLW_DIR_PATH . 'includes/class-flw-payment-list.php';
		require_once FLW_DIR_PATH . 'includes/vc-elements/class-flw-vc-simple-form.php';
		require_once FLW_DIR_PATH . 'src/Exception/class-apiexception.php';
		require_once FLW_DIR_PATH . 'src/API/class-handler.php';
		require_once FLW_DIR_PATH . 'src/API/class-client.php';

		require_once FLW_DIR_PATH . 'includes/api/class-flw-transaction-rest-route.php';
		require_once FLW_DIR_PATH . 'includes/api/class-flw-webhook-rest-route.php';
		require_once FLW_DIR_PATH . 'includes/class-flw-shortcodes.php';
		require_once FLW_DIR_PATH . 'includes/integrations/class-flw-thirdparty-integrations.php';

		if ( is_admin() ) {
			require_once FLW_DIR_PATH . 'includes/class-flw-tinymce-plugin.php';
		}
	}

	/**
	 * Initialize all the included classe
	 *
	 * @return void
	 */
	private function init() {

		if ( ! shortcode_exists( 'flw-pay-button' ) && ! shortcode_exists( 'flw-donation-page' ) ) {
			// include shortcodes.
			require_once FLW_DIR_PATH . 'includes/shortcodes/class-abstract-flw-shortcode.php';
			require_once FLW_DIR_PATH . 'includes/shortcodes/class-flw-shortcode-donation-form.php';
			require_once FLW_DIR_PATH . 'includes/shortcodes/class-flw-shortcode-payment-form.php';

			// initialize shortcodes.
			FLW_Shortcodes::get_instance();
		}
		$this->settings = FLW_Admin_Settings::get_instance();
		FLW_Payment_List::get_instance();
		$this->api_client = Client::get_instance( $this->get_option( 'secret_key' ) );

		if ( is_admin() ) {
			// TODO: Introduce Advanced TinyMCE Plugin.
			FLW_Tinymce_Plugin::get_instance();
		}

		// Initiate Endpoints.
		new FLW_Transaction_Rest_Route();
		new FLW_Webhook_Rest_Route();

		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		add_action( 'wp_ajax_process_payment', array( $this, 'process_payment' ) );
		add_action( 'wp_ajax_nopriv_process_payment', array( $this, 'process_payment' ) );
		add_action( 'wp_ajax_get_payment_url', array( $this, 'get_payment_url' ) );
		add_action( 'wp_ajax_nopriv_get_payment_url', array( $this, 'get_payment_url' ) );

		// Register Third party Services.
	}

	/**
	 * Register thirdparty integrations.
	 *
	 * @return void
	 */
	protected function register_third_party_integrations() {
		// Third party Services.
		require_once FLW_DIR_PATH . 'src/Integrations/class-abstractservice.php';
		require_once FLW_DIR_PATH . 'src/Integrations/ApiLayer/class-exchangerateservice.php';

		// get flutterwave integration options.

		$services = array(
			ExchangeRateService::class,
		);

		$registry = FLW_Thirdparty_Integrations::get_instance();
		$registry::register( $services );

	}

	/**
	 * Get Plugin options.
	 *
	 * @param string $name The name of the option.
	 *
	 * @return mixed
	 */
	private function get_option( string $name ) {
		return $this->settings->get_option_value( $name );
	}

	/**
	 * Adds admin settings page to the dashboard
	 *
	 * @return void
	 */
	public function admin_notices() {
		$no_public_key = empty( $this->get_option( 'public_key' ) ?? '' );
		$no_secret_key = empty( $this->get_option( 'secret_key' ) ?? '' );

		if ( $no_secret_key || $no_public_key ) {
			echo '<div class="updated"><p>';
			esc_attr_e( 'Flutterwave Payments is installed. - ', 'rave-payment-forms' );
			echo '<a href=' . esc_url( add_query_arg( 'page', $this->plugin_name, admin_url( 'admin.php' ) ) ) . " class='button-primary'>";
			esc_attr_e( 'Enter your Flutterwave "Pay Checkout" Public Key and Secret Key to start accepting payments', 'rave-payment-forms' );
			echo '</a></div>';
		}

	}

	/**
	 * Generate Payment Hash.
	 *
	 * @param array $payment_data data to hash.
	 *
	 * @return string
	 */
	private static function generate_payment_hash( array $payment_data ) {
		$data_to_join = array(
			'amount'     => $payment_data['amount'],
			'currency'   => $payment_data['currency'],
			'email'      => $payment_data['email'],
			'tx_ref'     => $payment_data['tx_ref'],
			'secret_key' => ( FLW_Admin_Settings::get_instance() )->get_option_value( 'secret_key' ),
		);

		$string_to_hash = '';
		foreach ( $data_to_join as $key => $value ) {
			if ( 'secret_key' === $key ) {
				$string_to_hash .= hash( 'sha256', $value );
			} else {
				$string_to_hash .= $value;
			}
		}

		return hash( 'sha256', $string_to_hash );
	}

	/**
	 * Generate Payment Link with Standard Endpoint.
	 *
	 * @return void
	 */
	public function get_payment_url() {
		check_ajax_referer( 'flw-rave-pay-nonce', 'flw_sec_code' );

		$amount          = isset( $_POST['amount'] ) ? sanitize_text_field( wp_unslash( $_POST['amount'] ) ) : null;
		$email           = isset( $_POST['customer']['email'] ) ? sanitize_email( wp_unslash( $_POST['customer']['email'] ) ) : null;
		$country         = isset( $_POST['country'] ) ? sanitize_text_field( wp_unslash( $_POST['country'] ) ) : 'NGN';
		$form_id         = isset( $_POST['form_id'] ) ? sanitize_text_field( wp_unslash( $_POST['form_id'] ) ) : null;
		$tx_ref          = 'WP_' . $form_id . wp_rand( 20, 15003 ) . '_' . time();
		$currency        = isset( $_POST['currency'] ) ? sanitize_text_field( wp_unslash( $_POST['currency'] ) ) : null;
		$name            = isset( $_POST['customer']['name'] ) ? sanitize_text_field( wp_unslash( $_POST['customer']['name'] ) ) : null;
		$phone           = ( isset( $_POST['customer']['phone_number'] ) ) ? sanitize_text_field( wp_unslash( $_POST['customer']['phone_number'] ) ) : null;
		$payment_options = isset( $_POST['payment_options'] ) ? sanitize_text_field( wp_unslash( $_POST['payment_options'] ) ) : null;
		$title           = get_bloginfo( 'name' );
		$payment_type    = ( isset( $_POST['payment_type'] ) && 'once' !== $_POST['payment_type'] ) ? sanitize_text_field( wp_unslash( $_POST['payment_type'] ) ) : 'once';

		$payment_hash_args = array(
			'amount'   => $amount,
			'currency' => $currency,
			'email'    => $email,
			'tx_ref'   => $tx_ref,
		);

		$payment_hash = $this->generate_payment_hash( $payment_hash_args );
		$ip_address   = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '127.0.0.1';

		$args = array(
			'post_type'   => 'payment_list',
			'post_status' => 'publish',
			'post_title'  => $tx_ref,
		);

		$payment_record_id = wp_insert_post( $args, true );

		if ( ! is_wp_error( $payment_record_id ) ) {

			$post_meta = array(
				'_flw_rave_payment_amount'   => (float) $amount,
				'_flw_rave_payment_fullname' => $name,
				'_flw_rave_payment_customer' => $email,
				'_flw_rave_payment_currency' => $currency,
				'_flw_rave_payment_status'   => 'pending',
				'_flw_rave_payment_tx_ref'   => $tx_ref,
			);
			$this->add_post_meta( $payment_record_id, $post_meta );
		}
		$redirect_url = get_site_url() . '/wp-json/flutterwave/v1/verify-transaction?order=' . $payment_record_id;
		// check for payment type.

		$payload = array(
			'tx_ref'          => $tx_ref,
			'amount'          => $amount,
			'currency'        => $currency,
			'country'         => $country,
			'redirect_url'    => $redirect_url,
			'payment_options' => $payment_options,
			'payment_hash'    => $payment_hash,
			'customer'        => array(
				'email'       => $email,
				'phonenumber' => $phone,
				'name'        => $name,
			),
			'meta'            => array(
				'form_id'        => $form_id,
				'ip_address'     => $ip_address,
				'order_id'       => $payment_record_id,
				'order_amount'   => $amount,
				'order_currency' => $currency,
			),
			'customizations'  => array(
				'title'       => $title,
				'description' => 'Payment #' . $payment_record_id ?? '2019384',
			),
		);

		if ( 'once' !== $payment_type ) {
			$key = $amount . '_' . $currency . '_' . $payment_type;
			// check if the payment_plan exists in transient.
			if ( ! get_transient( $key ) ) {

				$plan_id = $this->generate_payment_plan(
					array(
						'amount'   => $amount,
						'name'     => 'donation_' . $amount . '_' . $payment_type,
						'interval' => $payment_type,
						'currency' => $currency,
					)
				);

				set_transient( $key, $plan_id );
			} else {
				$plan_id = get_transient( $key );
			}
			$payload['payment_plan'] = $plan_id;
		}

		$response = $this->api_client->request(
			'/payments',
			'POST',
			$payload
		);

		if ( is_wp_error( $response ) ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'message' => $response->get_error_message(),
				),
				400
			);

			wp_die();
		}
		$response = json_decode( wp_remote_retrieve_body( $response ) );
		wp_send_json(
			array(
				'status' => 'success',
				'data'   => $payload,
				'url'    => $response->data->link,
			),
			200
		);

		wp_die();
	}

	/**
	 * Processes payment record information
	 *
	 * @return void
	 */
	public function process_payment() {

		global $admin_settings;

		// TODO: Payment status should be pending at the moment.
		$redirect_url_key = 'failed_redirect_url';

		check_ajax_referer( 'flw-rave-pay-nonce', 'flw_sec_code' );

		$tx_ref = isset( $_POST['tx_ref'] ) ? sanitize_text_field( wp_unslash( $_POST['tx_ref'] ) ) : null;

		$res_data = json_decode( $this->fetch_transaction( $tx_ref ) );

		if ( is_object( $res_data->data ) && $this->is_successful( $res_data->data ) ) {
			$status            = $res_data->data->status;
			$customer_fullname = $res_data->data->customer->name;
			$customer_email    = $res_data->data->customer->email;
			$customer_id       = $res_data->data->customer->id;
			$amount            = $res_data->data->amount;

			$args = array(
				'post_type'   => 'payment_list',
				'post_status' => 'publish',
				'post_title'  => $tx_ref,
			);

			$payment_record_id = wp_insert_post( $args, true );

			if ( ! is_wp_error( $payment_record_id ) ) {

				$post_meta = array(
					'_flw_rave_payment_amount'   => $amount,
					'_flw_rave_payment_fullname' => $customer_fullname,
					'_flw_rave_payment_customer' => $customer_email,
					'_flw_rave_payment_status'   => $status,
					'_flw_rave_payment_tx_ref'   => $tx_ref,
				);
				$this->add_post_meta( $payment_record_id, $post_meta );
			}

			if ( 'successful' === $status ) {
				$redirect_url_key = 'success_redirect_url';
			}

			echo wp_json_encode(
				array(
					'status'       => $status,
					'redirect_url' => $admin_settings->get_option_value( $redirect_url_key ),
				)
			);
			die();
		}

		echo wp_json_encode(
			array(
				'status'       => $res_data->status,
				'redirect_url' => $admin_settings->get_option_value( $redirect_url_key ),
			)
		);
		die();
	}

	/**
	 * Processes payment record information
	 *
	 * @param int $len length of string.
	 *
	 * @return string
	 */
	public static function gen_rand_string( $len = 4 ) {

		if ( version_compare( PHP_VERSION, '5.3.0' ) <= 0 ) {
			return substr( md5( wp_rand() ), 0, $len );
		}
		return bin2hex( openssl_random_pseudo_bytes( $len / 2 ) );
	}

	/**
	 * Fetches transaction from flutterwave endpoint
	 *
	 * @param string $tx_ref Transaction reference.
	 *
	 * @return string
	 */
	private function fetch_transaction( $tx_ref ): string {
		$url      = '/transactions/verify_by_reference?tx_ref=' . $tx_ref;
		$response = $this->api_client->request( $url );

		return wp_remote_retrieve_body( $response );
	}

	/**
	 * Checks if payment is successful
	 *
	 * @param object $data  the transaction object to do the check on.
	 *
	 * @return boolean
	 */
	private function is_successful( object $data ): bool {
		return 'successful' === $data->status;
	}

	/**
	 * Adds metadata to payment list post type
	 *
	 * @param [int]   $post_id  The ID of the post to add metadata to.
	 * @param [array] $data     Collection of the data to be added to the post.
	 */
	private function add_post_meta( $post_id, $data ) {

		foreach ( $data as $meta_key => $meta_value ) {
			update_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	/**
	 * Generate Payment Plan.
	 *
	 * @param array $data  create a payment plan.
	 *
	 * @return int|WP_Error
	 */
	protected function generate_payment_plan( array $data ) {
		// amount, name, interval.
		$response = $this->api_client->request(
			'/payment-plans',
			'POST',
			$data
		);

		$body = json_decode( wp_remote_retrieve_body( $response ) );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		return (int) $body->data->id;
	}

	/**
	 * Gets the instance of this class
	 *
	 * @return object the single instance of this class.
	 */
	public static function get_instance(): object {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}


