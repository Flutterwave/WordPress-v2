<?php

  if ( ! defined( 'ABSPATH' ) ) { exit; }

  global $payment_forms;

  $form_id = FLW_Rave_Pay::gen_rand_string();

  if (!empty($atts['custom_currency'])) {
    if (preg_match('/^[a-z\d]* [a-z\d]*$/', $atts['custom_currency'])) {
      $currencies = explode(", ", $atts['custom_currency']);
    } else{
      $currencies = explode(",", $atts['custom_currency']);
    }
  }








?>

<div>
  <form id="<?php echo $form_id ?>" class="flw-simple-pay-now-form" <?php echo $data_attr; ?> >
    <div id="notice"></div>
    <?php if ( empty( $atts['email'] ) ) : ?>

      <label class="pay-now"><?php _e( 'Email', 'rave-pay' ) ?></label>
      <input class="flw-form-input-text" id="flw-customer-email" type="email" placeholder="<?php _e( 'Email', 'rave-pay' ) ?>" required /><br>

    <?php endif; ?>

    <?php if ( empty( $atts['firstname'] ) ) : ?>

      <label class="pay-now"><?php _e( 'First Name', 'rave-pay' ) ?> (Optional) </label>
      <input class="flw-form-input-text" id="flw-first-name" type="text" placeholder="<?php _e( 'First Name', 'rave-pay' ) ?>" /><br>

    <?php endif; ?>

    <?php if ( empty( $atts['lastname'] ) ) : ?>

      <label class="pay-now"><?php _e( 'Last Name', 'rave-pay' ) ?> (Optional) </label>
      <input class="flw-form-input-text" id="flw-last-name" type="text" placeholder="<?php _e( 'Last Name', 'rave-pay' ) ?>" /><br>

    <?php endif; ?>

    <?php if ( empty( $atts['amount'] ) ) : ?>

      <label class="pay-now"><?php _e( 'Amount', 'rave-pay' ); ?></label>
      <input class="flw-form-input-text" id="flw-amount" type="number" placeholder="<?php _e( 'Amount', 'rave-pay' ); ?>" required /><br>

    <?php endif; ?>


<?php    if (!empty($atts['extra_count'] && $atts['extra_count'] > 1)) {

$extra_fields = explode(",", $payment_forms->get_option_value('extra_field_1'));
foreach ($extra_fields as $key => $value) {?>

<?php if(array_key_exists($value, $atts) && empty( $atts[$value])){ ?>

<label class="pay-now"><?php _e( $value, 'rave-pay' ); ?></label>
<input class="flw-form-input-text" id="flw-meta" type="text" placeholder="<?php _e( $value, 'rave-pay' ); ?>" required /><br>

<?php }}}?>

<?php    if (!empty($atts['extra_checkbox_count'] && $atts['extra_checkbox_count'] > 1)) {

$extra_fields_checkbox = explode(",", $payment_forms->get_option_value('extra_field_2'));
foreach ($extra_fields_checkbox as $key => $value) {?>

<?php if(array_key_exists($value, $atts) && empty( $atts[$value] )){ ?>

<label class="pay-now"><?php _e( $value, 'rave-pay' ); ?></label>
<input class="" id="flw-meta" type="checkbox" placeholder="<?php _e( $value, 'rave-pay' ); ?>" required /><br>

<?php }}}?>


    


   
    <?php 
         
        //  print_r($atts);
    
    if ( !empty( $atts['recurring_payment'] ) ) : ?>

      <label class="pay-now"><?php _e( 'Recurring Payment', 'rave-pay' ) ?></label>
      <select class="flw-form-select" id="flw-payment-plan" required>
        <option value="">-- Select Interval --</option>
        <?php 
          foreach($atts['paymentplans'] as $key => $value){
            if ($atts['paymentplansenable'][$key] == 'yes')
              echo '<option value="'.$key.'">'.$value.'</option>';
          }
        ?>
      </select><br>

    <?php endif; ?>

    <?php if (empty($atts['currency'])) : ?>
      <label class="pay-now"><?php _e('Currency', 'rave-pay'); ?></label>
      <?php if (!empty($atts['custom_currency'])){ ?>

      <select class="flw-form-select" id="flw-currency" required>
        <?php foreach ($currencies as $currency): ?>
          <option value="<?php echo $currency ?>"><?php echo $currency ?></option>
        <?php endforeach; ?>
      </select>

      <?php } else{ ?>


      <?php if ($atts['country'] == "NG") : ?>
        <select class="flw-form-select" id="flw-currency" required>
          <option value="NGN">NGN</option>
          <option value="USD">USD</option>
          <option value="KES">KES</option>
          <option value="EUR">EUR</option>
          <option value="GBP">GBP</option>
        </select>
      <?php endif; ?>

      <?php if ($atts['country'] == "KE") : ?>
        <select class="flw-form-select" id="flw-currency" required>
          <option value="KES">KES</option>
        </select>
      <?php endif; ?>

      <?php if ($atts['country'] == "GH") : ?>
        <select class="flw-form-select" id="flw-currency" required>
          <option value="GHS">GHS</option>
          <option value="USD">USD</option>
        </select>
      <?php endif; ?>

      <?php if ($atts['country'] == "ZA") : ?>
        <select class="flw-form-select" id="flw-currency" required>
          <option value="ZAR">ZAR</option>
        </select>
      <?php endif; ?>

      <?php if ($atts['country'] == "US") : ?>
        <select class="flw-form-select" id="flw-currency" required>
          <option value="NGN">NGN</option>
          <option value="USD">USD</option>
          <option value="KES">KES</option>
          <option value="GHS">GHS</option>
          <option value="EUR">EUR</option>
          <option value="ZAR">ZAR</option>
          <option value="GBP">GBP</option>
        </select>
      <?php endif; ?>

        <?php 
      } ?>

    <?php endif; ?>
    <br>

    <?php wp_nonce_field( 'flw-rave-pay-nonce', 'flw_sec_code' ); ?>
    <button value="submit" class='flw-pay-now-button' href='#'><?php _e( $btn_text, 'rave-pay' ) ?></button>
  </form>
</div>
