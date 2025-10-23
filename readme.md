<p align="center">
    <img title="Flutterwave" height="200" src="https://flutterwave.com/images/logo/full.svg" width="50%"/>
</p>

# Flutterwave Payments

## Introduction

The WordPress Plugin makes it very easy and quick to add Flutterwave Payment options on your e-commerce site, Donation Page, or a list of Payment Subscriptions you want your clients to subscribe to.

Take donations and payments for services on your WordPress site using Flutterwave.


## Description


Available features include:

- Collections: Card, Account, Mobile money, Bank Transfers, USSD, Barter, NQR.
- Recurring payments: Tokenization and Subscriptions.
- Split payments: Split payments between multiple recipients.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Initialization](#initialization)
4. [Best Practices](#best-practices)
5. [Debugging Errors](#debugging-errors)
6. [Support](#support)
7. [Contribution guidelines](#contribution-guidelines)
9. [License](#)
10. [Changelog](#)


## Requirements

1. Flutterwave for business [API Keys](https://flutterwave.com/tz/support/my-account/getting-your-api-keys)
2. Supported PHP version: 7.4 or higher
3. For Elementor: Elementor version: 2.8.0 or higher

## Installation

### Automatic Installation
*   Log in to your WordPress Dashboard.
*   Click on "Plugins > Add New" from the left menu.
*   In the search box type __Flutterwave Payments__.
*   Click on __Install Now__ on __Flutterwave Payments__ to install the plugin on your site.
*   Confirm the installation.
*   Activate the plugin.
*   Go to "Rave > Settings" from the left menu to configure the plugin.


### Manual Installation
*  Download the plugin zip file.
*  Log in to your WordPress Admin. Click on "Plugins > Add New" from the left menu.
*  Click on the "Upload" option, then click "Choose File" to select the zip file you downloaded. Click "OK" and "Install Now" to complete the installation.
*  Activate the plugin.
*  Go to "Rave > Settings" from the left menu to configure the plugin.

For FTP manual installation, [check here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

## Best Practices

- When in doubt about a transaction, always check the Flutterwave Dashboard to confirm the status of a transaction.
- Always ensure you keep your API keys securely and privately. Do not share with anyone.
- Ensure you change from the default secret hash on the WordPress admin and apply the same on the Flutterwave Dashboard.
- Always ensure you install the most recent version of the Flutterwave WooCommerce plugin.

## Debugging Errors

We understand that you may run into some errors while integrating our plugin. You can read more about our error messages [here](https://flutterwave.com/gb/support/general/common-transaction-errors).

For `authorization` and `validation` error responses, double-check your API keys and request. If you get a `server` error, kindly engage the team for support.

## Support

For additional assistance using this library, contact the developer experience (DX) team via [email](mailto:developers@flutterwavego.com) or on [slack](https://bit.ly/34Vkzcg).

You can also follow us [@FlutterwaveEng](https://twitter.com/FlutterwaveEng) and let us know what you think ðŸ˜Š.

### Configure the plugin
To configure the plugin, go to __Rave > Settings__ from the left menu.

###
![Rave Settings Screenshot](https://cloud.githubusercontent.com/assets/8383666/21610555/f1b32abc-d1c8-11e6-8d53-e77c9e35a6c7.png)

* __Pay Button Public Key__ - Enter your public key, which can be retrieved from the "Pay Buttons" page on your Rave account dashboard.
* __Recurring Payments__ - To enable recurring payments/subscription for your users, click the Enable Recurring Payment 'checkbox' to enable it. Go to your Rave Dashboard, navigate to 'Payment Plans', and click the 'Create Payment Plan' button to create a payment plan with an interval. The intervals accepted for this plugin are WEEKLY, MONTHLY, QUARTERLY, ANNUALLY/YEARLY.
* __Modal Title__ - (Optional) Customize the title of the Pay Modal. Default is FLW PAY.
* __Modal Description__ - (Optional) Customize the description on the Pay Modal. Default is FLW PAY MODAL.
* __Modal Logo__ - (Optional) Customize the logo on the Pay Modal. Enter a full URL (with 'http'). Default is the Rave logo.
* __Success Redirect URL__ - (Optional) The URL the user should be redirected to after a successful payment. Enter a full URL (with 'http'). Default: "".
* __Failed Redirect URL__ - (Optional) The URL the user should be redirected to after a failed payment. Enter a full URL (with 'http'). Default: "".
* __Pay Button Text__ - (Optional) The text to display on the button. Default: "PAY NOW".
* __Charge Currency__ - (Optional) The currency the user is charged. Default: "NGN".
* __Charge Country__ - (Optional) The country the merchant is serving. Default: "NG: Nigeria".
* __Form Style__ - (Optional) Disable form default style and use the activated theme style instead.
* Click __Save Changes__ to save your changes.

### Styling
You can enable the default theme's style to override the default form style from the __Settings__ page.
Or you can override the _form_ class `.flw-simple-pay-now-form` from your stylesheet.


## Usage ##

####1. Shortcode

Insert the shortcode anywhere on your page or post where you want the form to be displayed to the user.

Basic: _requires the user to enter the amount and email to complete payment_
```
[flw-pay-button]
```

With button text:
```
[flw-pay-button]Button Text[/flw-pay-button]
```

With attributes: _email_ or _use_current_user_email_ with value "yes", _amount_
```
[flw-pay-button amount="1290" email="customer@email.com" ]

or

[flw-pay-button amount="1290" use_current_user_email="yes" ]
```

With attributes and button text: _email_, _amount_
```
[flw-pay-button amount="1290" email="customer@email.com" ]Button Text[/flw-pay-button]

or

[flw-pay-button amount="1290" email="customer@email.com" split_name=1 ]Button Text[/flw-pay-button]


```

With custom and excluded fields.
```
[flw-pay-form amount=1234 fullname="Abraham Olaobaju" currency="USD,UGX,NGN" custom_fields='age:number,color:select|black:#000|white:#fff' exclude="phone"]

```

With the order rearranged.
```
[flw-pay-form amount=1234 fullname=" Abraham Olaobaju" currency="USD,UGX,NGN" order="currency,fullname,amount,phone,email"]
```

Donation Form.
```
[flw-donation-form]
```

####2. Visual Composer

The shortcode can be added via Visual Composer elements.

* On the Visual Composer __Add Element__ dialog, click on "__Rave Forms__" and select the type of form you want to include on your page.
  ![Visual Composer Screenshot 1](https://cloud.githubusercontent.com/assets/8383666/21606192/20887a10-d1ae-11e6-85f7-6f8771cb8688.png)
###

* On the "Form Settings" dialog, fill in the form attributes and click "__Save Changes__".
  ![Visual Composer Screenshot 2](https://cloud.githubusercontent.com/assets/8383666/21606210/381994b6-d1ae-11e6-8731-810be5550f55.png)
###

* Payment Form successfully added to the page.
  ![Visual Composer Screenshot 3](https://cloud.githubusercontent.com/assets/8383666/21606217/46200ed2-d1ae-11e6-812b-7d5a2c1f6b43.png)
###

## Transaction List ##

All the payments made through the forms to Rave can be accessed on the __Rave > Transactions__ page.

![Rave Transactions Screenshot](https://cloud.githubusercontent.com/assets/8383666/21606454/01022040-d1b0-11e6-8c61-755cea93ea14.png)

## Contribution guidelines

We love to get your input. Read more about our community contribution guidelines [here](/CONTRIBUTING.md)

## License

By contributing to the Rave WooCommerce Plugin, you agree that your contributions will be licensed under its [MIT license](/LICENSE).

Copyright (c) Flutterwave Inc. 
