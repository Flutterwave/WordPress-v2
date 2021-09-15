<?php

  if ( ! defined( 'ABSPATH' ) ) { exit; }

  global $payment_forms;
    global $admin_settings;
  $form_id = FLW_Rave_Pay::gen_rand_string();

//   if (!empty($atts['custom_currency'])) {
//     if (preg_match('/^[a-z\d]* [a-z\d]*$/', $atts['custom_currency'])) {
//       $currencies = explode(", ", $atts['custom_currency']);
//     } else{
//       $currencies = explode(",", $atts['custom_currency']);
//     }
//   }
echo '<script> var donation_plan = '.$admin_settings->get_option_value( 'donation_payment_plan' ).'; pp = donation_plan;</script>';

$donation_phone  = $admin_settings->get_option_value( 'donation_phone' );
$donation_heading = $admin_settings->get_option_value( 'donation_title' );
$donation_details = $admin_settings->get_option_value( 'donation_desc' );
$donation_merchant_name = $admin_settinggs->get_option_value('donation_merchant_name');

?>

<body>

    <div class="loading-donation-page" style="text-align:center">
        <img src="<?php echo plugins_url('assets/images/donation-loading.gif', FLW_PAY_PLUGIN_FILE); ?>" alt="" srcset="" style="margin-left: auto;margin-right: auto;margin-top:4em">
        <p>Loading Donation page</p>
    </div>
    <div class="contact" style="background:#F4F6F8; display:none">
        <div class="contact_top">

            <div class="contact_top_left">
                <span>
                    <a href="" target="_blank"></a>
                </span>
            </div>
            <div class="contact_top_right">

                <span class="">
                    <a href="tel:<?php  echo $donation_phone; ?>"><?php  echo $donation_phone; ?></a>
                </span>

            </div>

        </div>
        
        

        <!-- the form wrapper -->
        <div class="wrapper" style="background-image:linear-gradient(rgba(18, 18, 44, 0.8), rgba(18, 18, 44, 0.8))">

            <div class="donation__section">

                <div class="donation__section__left">
                    <p><?php echo $donation_merchant_name; ?></p>
                     <h1 class="donation__section__left__header"><?php echo $donation_heading; ?></h1> 
                     <p class="donation__section__left__description"><?php echo $donation_details; ?></p> 
                    <div class="donation__section__left__learn-more-link"><!---->
                    </div>
                </div>
    
                <div class="donation__section__right">
    
                    <div class="form_bottom">
    
                        <div class="donation-form">
        
                            <form id="<?php echo $form_id ?>" action="" method="get" class="flw-donation-pay-now-form">
                                <div class="form__item form__item--marginBottom-12">
                                    <div class="radio-group">
                                        <div class="radio-box-group--left" >
                                            <input type="radio" name="donationPeriod" id="once" value="once" required="required" class="form__input"> <label for="once">Give Once</label>
                                        </div> 
                                        <div class="radio-box-group--right">
                                            <input type="radio" name="donationPeriod" id="monthly" value="monthly" required="required" class="form__input"> <label for="monthly">Monthly</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__inner">
                                    <div class="form__item form__item--marginBottom-12">
                                        <label for="" class="form__label">First Name</label> 
                                        <input type="text" autocomplete="first_name" required="required" id="flw-first-name" class="form__input"> <!---->
                                    </div>
            
                                    <div class="form__item form__item--marginBottom-12">
                                        <label for="" class="form__label">Last Name</label> 
                                        <input type="text" autocomplete="last_name" required="required" id="flw-last-name"  class="form__input"> <!---->
                                    </div>
            
                                    <div class="form__item form__item--marginBottom-12">
                                        <label for="" class="form__label">Email Address</label> 
                                        <input type="email" autocomplete="email_address" required="required" id="flw-customer-email"   class="form__input"> <!---->
                                    </div> 
                                    <div class="form__item form__item--marginBottom-12">
                                        <label for="" class="form__label">Amount</label> 
                                        <div class="newObject">
                                            <div class="newObject__select">
                                            <div class="select">
                                                <select  id="flw-currency" class="select__input select__input--noRightBorderRadius select__input--transparent" autocomplete="currency_field">
                                                    <option value="USD">USD</option>
                                                    <option value="AED">AED</option>
                                                    <option value="ARS">ARS</option>
                                                    <option value="AUD">AUD</option>
                                                    <option value="BGN">BGN</option>
                                                    <option value="BRL">BRL</option>
                                                    <option value="BWP">BWP</option>
                                                    <option value="CAD">CAD</option>
                                                    <option value="CFA">CFA</option>
                                                    <option value="CHF">CHF</option>
                                                    <option value="CNY">CNY</option>
                                                    <option value="COP">COP</option>
                                                    <option value="CRC">CRC</option>
                                                    <option value="CZK">CZK</option>
                                                    <option value="DKK">DKK</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="GBP">GBP</option>
                                                    <option value="GHS">GHS</option>
                                                    <option value="HKD">HKD</option>
                                                    <option value="HUF">HUF</option>
                                                    <option value="ILS">ILS</option>
                                                    <option value="INR">INR</option>
                                                    <option value="JPY">JPY</option>
                                                    <option value="KES">KES</option>
                                                    <option value="MAD">MAD</option>
                                                    <option value="MOP">MOP</option>
                                                    <option value="MUR">MUR</option>
                                                    <option value="MXN">MXN</option>
                                                    <option value="MYR">MYR</option>
                                                    <option value="NGN">NGN</option>
                                                    <option value="NOK">NOK</option>
                                                    <option value="NZD">NZD</option>
                                                    <option value="PEN">PEN</option>
                                                    <option value="PHP">PHP</option>
                                                    <option value="PLN">PLN</option>
                                                    <option value="RUB">RUB</option>
                                                    <option value="RWF">RWF</option>
                                                    <option value="SAR">SAR</option>
                                                    <option value="SEK">SEK</option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="SLL">SLL</option>
                                                    <option value="THB">THB</option>
                                                    <option value="TRY">TRY</option>
                                                    <option value="TWD">TWD</option>
                                                    <option value="TZS">TZS</option>
                                                    <option value="UGX">UGX</option>
                                                    <option value="VEF">VEF</option>
                                                    <option value="XAF">XAF</option>
                                                    <option value="XOF">XOF</option>
                                                    <option value="ZAR">ZAR</option>
                                                    <option value="ZMK">ZMK</option>
                                                    <option value="ZMW">ZMW</option>
                                                    <option value="ZWD">ZWD</option>
                                                </select> 
                                                <div class="select__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10"><path fill="#637381" fill-rule="evenodd" d="M6.03 3.03L3.025.025.02 3.03h6.01zM5.88 7.071L2.975 9.975.07 7.07H5.88z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="newObject__input">
                                            <input type="text" spellcheck="false"  id="flw-amount" placeholder="1000" class="form__input form__input--noLeftBorderRadius">
                                            <input type="hidden" id="flw-payment-plan" value="">
                                        </div>
                                    </div> <!---->
                                </div>
                                <?php wp_nonce_field( 'flw-rave-pay-nonce', 'flw_sec_code' ); ?>
                                <div class="form__item form__item--noBottomMargin textCenter" style="margin-top: 30px;">
                                    <button type="submit" id="flw-donation-pay-button" class="btn btn--primary btn--pay btn--block text-uppercase hidden--xs" style="background-color:#F5A623">
                                        Donate NGN 1,000 once
                                    </button> 
                                    <button type="submit" id="flw-donation-pay-button" class="btn btn--primary btn--pay btn--block text-uppercase show--xs" style="background-color:#F5A623">
                                        Donate
                                    </button>
                                </div>
                            </div>
                            </form>
            
                            <div class="secured__badge donation__section__right__badge">
                            <div class="secured__badge__container"><div class="secured__badge__icon" >
                                <img src="<?php echo plugins_url('assets/images/flw-lock.png', FLW_PAY_PLUGIN_FILE); ?>" alt="flw-lock" />       
                            </div> 
                            <div class="secured__badge__text">
                            SECURED BY FLUTTERWAVE
                            </div>
                        </div>
                
        
        
                            </div>
        
        
                        </div>
                    
            
                    </div>
    
                </div>

            </div>


        




        </div>
        <!-- end of form wrapper -->
    </div>

    <script>

        // document.addEventListener("DOMContentLoaded", function(event) {
        //     jQuery('.contact').show();
        //     jQuery('.loading-donation-page').hide();
        //     console.log("document");
        // });
        
        // setTimeout(() => {
        //     jQuery('.contact').show();
        //     jQuery('.loading-donation-page').hide();
        // }, 3000);
        
        window.onload = function() {
            jQuery('.contact').show();
            jQuery('.loading-donation-page').hide();
            console.log("window");
        }

    </script>
    
</body>
