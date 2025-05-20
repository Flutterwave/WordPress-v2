<?php
/**
 * Flutterwave Payments Settings Page
 *
 * @package Flutterwave\Payments\Views
 * @version 1.0.6
 */

defined( 'ABSPATH' ) || exit;

$settings = FLW_Admin_Settings::get_instance();

?>

  <div class="wrap">
	<h1>Flutterwave Settings</h1>
	<form id="rave-pay" action="options.php" method="post" enctype="multipart/form-data">
	  <?php settings_fields( 'flw-rave-settings-group' ); ?>
	  <?php do_settings_sections( 'flw-rave-settings-group' ); ?>
	  <table class="form-table">
		<tbody>

		  <!-- Public Key -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[public_key]"><?php esc_attr_e( 'Pay Button Public Key', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[public_key]" value="<?php echo esc_attr( $settings->get_option_value( 'public_key' ) ); ?>" />
			  <p class="description">Flutterwave public key</p>
			</td>
		  </tr>
		  <!-- Secret Key -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[secret_key]"><?php esc_attr_e( 'Pay Button Secret Key', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[secret_key]" value="<?php echo esc_attr( $settings->get_option_value( 'secret_key' ) ); ?>" />
			  <p class="description">Flutterwave secret key</p>
			</td>
		  </tr>

		<!-- Secret Key -->
		<tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[secret_hash]"><?php esc_attr_e( 'Secret Hash', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[secret_hash]" value="<?php echo esc_attr( $settings->get_option_value( 'secret_hash' ) ); ?>" />
			  <p class="description">Flutterwave secret Hash</p>
			</td>
		  </tr>

		<!-- Webhook -->
		<tr valign="top">
			<th scope="row">
			  <label><?php esc_attr_e( 'Webhook URL', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <p class="description">
			  <?php esc_attr_e( 'Please copy this webhook URL and paste on the webhook section on your dashboard', 'rave-payment-forms' ); ?><strong style="color: red"><pre><code><?php echo esc_attr( get_site_url() ) . '/wp-json/flutterwave/v1/webhook'; ?></code></pre></strong><a href="https://app.flutterwave.com/dashboard/settings/webhooks" target="_blank">Flutterwave Account</a>
			  </p>
			</td>
		  </tr>

		  <!-- Switch to Live -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[go_live]"><?php esc_attr_e( 'Go Live', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-checkbox">
			  <fieldset>
				<?php $go_live = esc_attr( $settings->get_option_value( 'go_live' ) ); ?>
				<label>
				  <input type="checkbox" name="flw_rave_options[go_live]" <?php checked( $go_live, 'yes' ); ?> value="yes" />
				  <?php esc_attr_e( 'Switch to live account', 'rave-payment-forms' ); ?>
				</label>
			  </fieldset>
			</td>
		  </tr>
		  <!-- Method -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[method]"><?php esc_attr_e( 'Payment Method', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <select class="regular-text code" name="flw_rave_options[method]">
				<?php $method = esc_attr( $settings->get_option_value( 'method' ) ); ?>
				<option value="all" <?php selected( $method, 'all' ); ?>>All Payment Options</option>
				<option value="both" <?php selected( $method, 'both' ); ?>>Card and Account</option>
				<option value="card" <?php selected( $method, 'card' ); ?>>Card Only</option>
				<option value="account" <?php selected( $method, 'account' ); ?>>Account Only</option>
			  </select>
			  <p class="description">(Optional) default: All Payment Options</p>
			</td>
		  </tr>

		  <!-- Modal title -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[modal_title]"><?php esc_attr_e( 'Modal Title', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[modal_title]" value="<?php echo esc_attr( $settings->get_option_value( 'modal_title' ) ); ?>" />
			  <p class="description">(Optional) default: FLW PAY</p>
			</td>
		  </tr>
		  <!-- Modal Description -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[modal_desc]"><?php esc_attr_e( 'Modal Description', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[modal_desc]" value="<?php echo esc_attr( $settings->get_option_value( 'modal_desc' ) ); ?>" />
			  <p class="description">(Optional) default: FLW PAY MODAL</p>
			</td>
		  </tr>
		  <!-- Modal Logo -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[modal_logo]"><?php esc_attr_e( 'Modal Logo', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[modal_logo]" value="<?php echo esc_attr( $settings->get_option_value( 'modal_logo' ) ); ?>" />
			  <p class="description">(Optional) - Full URL (with 'https') to the custom logo. default: Flutterwave logo</p>
			</td>
		  </tr>
		  <!--  Donation Title -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[donation_title]"><?php esc_attr_e( 'Donation Title', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[donation_title]" value="<?php echo esc_attr( $settings->get_option_value( 'donation_title' ) ); ?>" />
			  <p class="description">(Optional) default: Donation Title</p>
			</td>
		  </tr>
		  <!--  Donation Description -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[donation_desc]"><?php esc_attr_e( 'Donation Description', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[donation_desc]" value="<?php echo esc_attr( $settings->get_option_value( 'donation_desc' ) ); ?>" />
			  <p class="description">(Optional) default: Donation Desc</p>
			</td>
		  </tr>
		  <!--  Donation Phone -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[donation_phone]"><?php esc_attr_e( 'Donation Phone', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[donation_phone]" value="<?php echo esc_attr( $settings->get_option_value( 'donation_phone' ) ); ?>" />
			  <p class="description">(Optional) default: 08000000000</p>
			</td>
		  </tr>
		 <!-- Pending Redirect URL -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[pending_redirect_url]"><?php esc_attr_e( 'Pending Redirect URL', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[pending_redirect_url]" value="<?php echo esc_attr( $settings->get_option_value( 'pending_redirect_url' ) ); ?>" />
			  <p class="description">(Optional) Full URL (with 'http') to redirect to for pending transactions. default: ""</p>
			</td>
		  </tr>
		  <!-- Successful Redirect URL -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[success_redirect_url]"><?php esc_attr_e( 'Success Redirect URL', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[success_redirect_url]" value="<?php echo esc_attr( $settings->get_option_value( 'success_redirect_url' ) ); ?>" />
			  <p class="description">(Optional) Full URL (with 'http') to redirect to for successful transactions. default: ""</p>
			</td>
		  </tr>
		  <!-- Failed Redirect URL -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[failed_redirect_url]"><?php esc_attr_e( 'Failed Redirect URL', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[failed_redirect_url]" value="<?php echo esc_attr( $settings->get_option_value( 'failed_redirect_url' ) ); ?>" />
			  <p class="description">(Optional) Full URL (with 'http') to redirect to for failed transactions. default: ""</p>
			</td>
		  </tr>
		  <!-- Failed Redirect URL -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[donation_payment_plan]"><?php esc_attr_e( 'Donation Plan Id', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[donation_payment_plan]" value="<?php echo esc_attr( $settings->get_option_value( 'donation_payment_plan' ) ); ?>" />
			</td>
		  </tr>
		  <!-- Pay Button Text -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[btn_text]"><?php esc_attr_e( 'Pay Button Text', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <input class="regular-text code" type="text" name="flw_rave_options[btn_text]" value="<?php echo esc_attr( $settings->get_option_value( 'btn_text' ) ); ?>" />
			  <p class="description">(Optional) default: PAY NOW</p>
			</td>
		  </tr>
		  <!-- Currency -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[currency]"><?php esc_attr_e( 'Charge Currency', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <select class="regular-text code" name="flw_rave_options[currency]">
				<?php $currency = esc_attr( $settings->get_option_value( 'currency' ) ); ?>
				<option value="any" <?php selected( $currency, 'any' ); ?>>Any (Let Customer decide or use Shortcode)</option>
				<option value="NGN" <?php selected( $currency, 'NGN' ); ?>>NGN</option>
				<option value="GHS" <?php selected( $currency, 'GHS' ); ?>>GHS</option>
				<option value="KES" <?php selected( $currency, 'KES' ); ?>>KES</option>
				<option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
				<option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
				<option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
				<option value="ZAR" <?php selected( $currency, 'ZAR' ); ?>>ZAR</option>
			  </select>
			  <p class="description">(Optional) default: NGN</p>
			</td>
		  </tr>
		  <!-- Country -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[country]"><?php esc_attr_e( 'Charge Country', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-text">
			  <select class="regular-text code" name="flw_rave_options[country]">
				<?php $country = esc_attr( $settings->get_option_value( 'country' ) ); ?>
				<option value="NG" <?php selected( $country, 'NG' ); ?>>NG: Nigeria</option>
				<option value="GH" <?php selected( $country, 'GH' ); ?>>GH: Ghana</option>
				<option value="KE" <?php selected( $country, 'KE' ); ?>>KE: Kenya</option>
				<option value="ZA" <?php selected( $country, 'ZA' ); ?>>ZA: South Africa</option>
				<option value="US" <?php selected( $country, 'US' ); ?>>All (Worldwide)</option>
			  </select>
			  <p class="description">(Optional) default: NG</p>
			</td>
		  </tr>

		  <!-- Styling -->
		  <tr valign="top">
			<th scope="row">
			  <label for="flw_rave_options[theme_style]"><?php esc_attr_e( 'Form Style', 'rave-payment-forms' ); ?></label>
			</th>
			<td class="forminp forminp-checkbox">
			  <fieldset>
				<?php $theme_style = esc_attr( $settings->get_option_value( 'theme_style' ) ); ?>
				<label>
				  <input type="checkbox" name="flw_rave_options[theme_style]" <?php checked( $theme_style, 'yes' ); ?> value="yes" />
				  <?php esc_attr_e( 'Use default theme style', 'rave-payment-forms' ); ?>
				</label>
				<p class="description">Override the form style and use the default theme's style</p>
			  </fieldset>
			</td>
		  </tr>

		</tbody>
	  </table>
	  <?php submit_button(); ?>
	</form>

  </div>
