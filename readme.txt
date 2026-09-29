=== Flutterwave Payments ===
Contributors: flutterwave
Tags: flutterwave, payment form, donation, mobile money, payment gateway
Requires at least: 6.4
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.1.0
License: MIT
License URI: https://opensource.org/licenses/MIT

Take payments and donations on any WordPress page, and let customers pay with cards, bank transfer, mobile money, Apple Pay or Google Pay.

== Description ==

**Flutterwave Payments is the official Flutterwave plugin for WordPress.** Add a payment button, payment form, donation form or pricing card to any page. Customers pay on Flutterwave's secure checkout with the method they already use, and the money goes to your Flutterwave account.

You don't need an online store, a developer or any code. A guided setup takes a few minutes, and you can try everything with test keys before taking real money.

= Why use Flutterwave Payments =

* **Let customers pay the way they want.** Cards (Visa, Mastercard, American Express), bank transfer, mobile money, Apple Pay, Google Pay, Opay and stablecoins (USDT and USDC). USSD, QR, NQR, Barter and Credit are also available.
* **Accept local and international money.** Charge in NGN, GHS, KES, ZAR, TZS, UGX, RWF, ZMW, USD, GBP or EUR, or let customers choose.
* **Go live in minutes.** Guided setup walks you through your business details, API keys, webhook and payment methods. It creates your webhook secret for you and tells you whether you're using test or live keys.
* **Use the block editor.** Five blocks, each with its own colours, corner radius and button text.
* **Collect regular donations.** Donors can give once, monthly or yearly, and you can suggest amounts.
* **See every payment in WordPress.** Filter by date, status and currency, check a payment again with Flutterwave, and download a CSV for your accounts.
* **Know what each form earns.** The Payment Forms screen lists every form on your site, the page it's on and the payments it has taken.
* **Connect the plugins you already use.** Easy Digital Downloads and GiveWP gateways are built in, and the Flutterwave WooCommerce extension installs in one click.

= Blocks =

Open the block inserter and choose the **Flutterwave** category.

* **Payment Button:** an email field and a pay button for a fixed amount, like "Pay NGN 5,000". Logged-in users can skip the email.
* **Payment Form:** a full form with an optional heading and description, and a fixed amount or one the customer enters. Name and phone fields are optional.
* **Donation Form:** one-off, monthly or yearly donations, with up to six suggested amounts.
* **Pricing Card:** a plan or product card with a price, a list of features, an optional badge and a checkout button.
* **Payment Methods:** a badge that shows customers which payment methods you accept, kept in step with your settings.

Button text can include `{amount}`, which is replaced with the formatted price.

= Shortcodes =

Prefer shortcodes, or using a page builder? Paste one into any page, post or widget. **Flutterwave > Payment Forms** has a builder with a live preview that writes the shortcode for you.

**Payment form:** `[flw-pay-form]`

* `amount="5000"`: fixed amount. Leave it out to let the customer enter one.
* `currency="NGN,USD,GBP"`: one currency, or several for the customer to choose from.
* `heading="Book a session"` and `description="..."`: text above the form.
* `use_current_user_email="yes"`: fills in the logged-in user's email.
* `split_name="1"`: separate first and last name fields.
* `exclude="phone"`: hides a field (`phone`, `fullname` or a custom field).
* `custom_fields="company:text,size:select|Small:S|Large:L"`: adds your own fields.
* `order="email,fullname,amount,currency"`: changes the field order.
* `layout="compact"`, `width="full"`, `show_secured="0"`: change the look.
* Button text goes between the tags: `[flw-pay-form amount="5000"]Pay {amount}[/flw-pay-form]`.

**Donation form:** `[flw-donation-form]`

* `heading` and `message`: text above the form.
* `currency="USD"`: the donation currency.
* `amounts="1000,5000,10000"`: suggested amounts.
* `show_frequency="0"`: one-off donations only.

`[flw-pay-button]` from earlier versions still works.

= Works with =

* **Easy Digital Downloads:** sell ebooks, software, music and other downloads with Flutterwave at checkout.
* **GiveWP:** collect donations through GiveWP forms and campaigns.
* **WooCommerce:** install the official Flutterwave WooCommerce extension from **Flutterwave > Integrations**.
* **Classic Editor and WPBakery:** a toolbar button and a "Flutterwave Simple Form" element insert a payment form.

WPForms, Gravity Forms, Contact Form 7, Paid Memberships Pro, MemberPress, LearnDash, Tutor LMS and Event Tickets are coming soon. You can tell us which one you need from the Integrations screen.

= Secure by design =

* Customers enter payment details on Flutterwave's checkout, never on your site.
* The amount and currency are signed on your server, so they can't be changed in the browser.
* Every payment is confirmed with Flutterwave before it's marked successful.
* Webhooks are only accepted with your secret hash, which is checked in constant time.
* Secret keys are masked in the admin, and checkout requests are rate-limited.

== Installation ==

= What you need =

* A [Flutterwave account](https://app.flutterwave.com/register). You can sign up for free and use test mode straight away.
* WordPress 6.4 or later and PHP 7.4 or later.

= Set up in five steps =

1. In your WordPress dashboard, go to **Plugins > Add New**, search for **Flutterwave Payments**, then click **Install Now** and **Activate**.
2. Go to **Flutterwave > Settings** and click **Activate Flutterwave** to start the guided setup.
3. **General details:** add your business name, logo and default currency.
4. **API & webhook:** paste your public and secret keys from **Settings > API Keys** in your Flutterwave dashboard. Then copy the webhook URL and secret hash from the plugin into **Settings > Webhooks** in the Flutterwave dashboard.
5. **Payment methods and redirects:** choose the methods you want to offer, and pick the pages customers see after a successful, failed or pending payment.

Now add a Flutterwave block or shortcode to any page. To try it first, use your test keys (they start with `FLWPUBK_TEST-`), and switch to live keys when you're ready.

You can change any setting later from the **General**, **API & Webhook**, **Payment Methods** and **Redirects** tabs.

= Manual installation =

Download the plugin zip, go to **Plugins > Add New > Upload Plugin**, choose the file and click **Install Now**, then activate it and follow the steps above.

== Frequently Asked Questions ==

= Do I need a Flutterwave account? =

Yes. Payments go to your Flutterwave account. [Sign up here](https://app.flutterwave.com/register). It's free to create an account, and you can test straight away.

= How much does it cost? =

The plugin is free. Flutterwave charges a fee on each successful payment. See the pricing page for your country on [flutterwave.com](https://flutterwave.com).

= Can I test without real money? =

Yes. Enter your test keys (`FLWPUBK_TEST-…` and `FLWSECK_TEST-…`) and the plugin shows that it's in test mode. Pay with one of Flutterwave's [test cards](https://developer.flutterwave.com/docs/testing); no real money moves.

= Which currencies and countries are supported? =

Forms can charge in NGN, GHS, KES, ZAR, TZS, UGX, RWF, ZMW, USD, GBP and EUR. Which payment methods your customers see depends on the currency and their country. Mobile money, for example, is offered in the countries where it's available.

= My form isn't showing on the page. Why? =

A form appears once your API keys and all three redirect pages (success, failed and pending) are saved. Until then, editors see a short notice with a link to the setting that's missing, and visitors see nothing.

= Why do I need a webhook? =

A webhook lets Flutterwave tell your site when a payment finishes, even if the customer closes the browser before returning to your site. Copy the webhook URL and secret hash from **Flutterwave > Settings > API & Webhook** into **Settings > Webhooks** in your Flutterwave dashboard. Without a secret hash, webhooks are refused.

= Can I take recurring payments? =

Donation forms let donors give monthly or yearly. The plugin creates the payment plan on Flutterwave for you.

= Does it work with WooCommerce? =

Yes. Install the official Flutterwave WooCommerce extension from **Flutterwave > Integrations**. For downloads and donations, the Easy Digital Downloads and GiveWP gateways are built into this plugin.

= Where do I see my payments? =

Under **Flutterwave > Transactions**. You can filter, check a payment again with Flutterwave, delete records and download a CSV. **Flutterwave > Payment Forms** shows what each form has taken. Your Flutterwave dashboard is always the final record.

= Can I match the forms to my theme? =

Yes. Blocks have colour, button text colour and corner radius controls. To use your theme's styles instead, turn on the theme style option under **Payment Methods** in the settings. Developers can also target `.flw-simple-pay-now-form` in CSS.

= Something went wrong. Where can I get help? =

Check your API keys first. Most `authorization` and `validation` errors come from a missing key or a test/live mix-up. For anything else, email [developers@flutterwavego.com](mailto:developers@flutterwavego.com) or open an issue on [GitHub](https://github.com/Flutterwave/WordPress-v2/issues).

== External services ==

This plugin connects to services run by Flutterwave Technology Solutions.

**Flutterwave payments API** (api.flutterwave.com) processes payments made through your forms. When a customer submits a form, the plugin sends the amount, currency, the customer's email, name and phone number, and a transaction reference to create the payment, then asks the API to verify it when the customer returns or a webhook arrives. The plugin also reads your account's transactions for the Transactions screen.

**Flutterwave integration analytics** (signozservice-prod.f4b-flutterwave.com) helps Flutterwave see whether integrations are working. The plugin sends:

* when your site is first set up: your public API key, the plugin name and version;
* when a payment starts: the transaction reference, whether you use test or live keys, and the plugin version;
* when a live payment succeeds: the transaction reference, amount, currency, fee and payment method;
* when something goes wrong: an error code and message, with the transaction reference where there is one.

No customer names, email addresses, phone numbers or card details are sent to the analytics service. To turn it off, add `define( 'FLW_DISABLE_TELEMETRY', true );` to wp-config.php, or return false from the `flw_signoz_enabled` filter.

Both services are covered by Flutterwave's [Terms of Service](https://flutterwave.com/us/terms) and [Privacy Notice](https://flutterwave.com/us/privacy-notice).

== Screenshots ==

1. Go to Flutterwave > Settings and click "Activate Flutterwave" to start the guided setup.
2. Add your Flutterwave API keys, then copy the webhook URL and secret hash into your Flutterwave dashboard.
3. Choose the payment methods customers can use: cards, bank transfer, mobile money, Apple Pay, Google Pay and more.
4. Change your settings at any time from the General, API & Webhook, Payment Methods and Redirects tabs.
5. See every payment made through your forms under Flutterwave > Transactions.
6. Add a payment form to any page with the [flw-pay-form] shortcode.
7. Collect one-off or recurring donations with the [flw-donation-form] shortcode.

== Changelog ==

= 1.1.0 =
* New: guided onboarding and a redesigned tabbed settings screen with webhook setup and test/live key detection.
* New: Payment Button, Payment Form, Donation Form, Pricing Card and Accepted Payment Methods blocks.
* New: Payment Forms screen showing every form in use, the page it is on and the payments it has taken, plus a form builder.
* New: redesigned Transactions screen with filters, a details drawer and CSV export for a date range.
* New: Easy Digital Downloads and GiveWP gateways, and one-click install of the Flutterwave WooCommerce extension.
* New: choose which payment methods are offered at checkout.
* New: more shortcode options for headings, descriptions, layout, suggested donation amounts and currency.
* Changed: payment and donation forms use the new Flutterwave design, and styles only load on pages with a form.
* Security: payment amount and currency are enforced on the server, and transactions are verified against the stored record.
* Security: webhooks are rejected unless a secret hash is configured.
* Security: fixed stored XSS in shortcode attributes and the transactions list; added checkout rate limiting.
* Fixed: checkout errors are now shown to customers, and name fields are shown on the payment form again.
* Fixed: translations loading too early on WordPress 6.7+.

= 1.0.3 =
* Add extra fields to the form.
* Set default values for fields.
* Hide a field by adding "-h" to its name.
* Mobile money for UGX, TZS and GHS.

= 1.0.2 =
* Recurring payments section added under "Payment Plan".

= 1.0.1 =
* Recurring payments enabled.

= 1.0.0 =
* First release.

== Upgrade Notice ==

= 1.1.0 =
Security release. Webhooks are now rejected unless a secret hash is set: after updating, add one under Flutterwave > Settings and in your Flutterwave dashboard.

= 1.0.1 =
Failed payments no longer redirect, so customers can try again. Adds multiple currencies and recurring payments.
