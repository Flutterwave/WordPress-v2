<p align="center">
    <img title="Flutterwave" height="200" src="https://flutterwave.com/images/logo/full.svg" width="50%"/>
</p>

# Flutterwave Payments for WordPress

The official Flutterwave plugin for WordPress. Add a payment button, payment form, donation form or pricing card to any page. Customers can pay with cards, bank transfer, mobile money, Apple Pay, Google Pay and more.

You don't need an online store, a developer or any code. A guided setup takes a few minutes, and you can try everything with test keys before taking real money.

## Table of contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation and setup](#installation-and-setup)
4. [Blocks](#blocks)
5. [Shortcodes](#shortcodes)
6. [Integrations](#integrations)
7. [Payments and reporting](#payments-and-reporting)
8. [Security](#security)
9. [External services](#external-services)
10. [Troubleshooting](#troubleshooting)
11. [Support](#support)
12. [Development](#development)
13. [License](#license)

## Features

- **Payment methods:** cards (Visa, Mastercard, American Express), bank transfer, mobile money, Apple Pay, Google Pay, Opay and stablecoins (USDT and USDC). USSD, QR, NQR, Barter and Credit are available under Advanced.
- **Currencies:** NGN, GHS, KES, ZAR, TZS, UGX, RWF, ZMW, USD, GBP and EUR. You can also let customers choose.
- **Guided setup:** business details, API keys, webhook, payment methods and redirects. It generates your webhook secret and tells you whether you're using test or live keys.
- **Five blocks:** payment button, payment form, donation form, pricing card and accepted payment methods, each with its own colours and corner radius.
- **Recurring donations:** donors can give once, monthly or yearly, and you can suggest amounts.
- **Payment Forms screen:** every form on your site, the page it's on and the payments it has taken, plus a builder with a live preview.
- **Transactions screen:** filter by date, status and currency, check a payment again with Flutterwave, and download a CSV.
- **Integrations:** Easy Digital Downloads and GiveWP gateways, and one-click install of the Flutterwave WooCommerce extension.

## Requirements

- A [Flutterwave account](https://app.flutterwave.com/register) and its [API keys](https://developer.flutterwave.com/docs/authentication).
- WordPress 6.4 or later.
- PHP 7.4 or later.

## Installation and setup

1. In your WordPress dashboard, go to **Plugins > Add New**, search for **Flutterwave Payments**, then click **Install Now** and **Activate**.
   To install manually, download the zip and use **Plugins > Add New > Upload Plugin**.
2. Go to **Flutterwave > Settings** and click **Activate Flutterwave** to start the guided setup.
3. **General details:** add your business name, logo and default currency. These appear on the Flutterwave checkout.
4. **API & webhook:** paste your public and secret keys from **Settings > API Keys** in your Flutterwave dashboard. Then copy the webhook URL and secret hash from the plugin into **Settings > Webhooks** in the Flutterwave dashboard.
5. **Payment methods:** choose the methods customers can use. You can also turn on your theme's form styles here.
6. **Redirects:** pick the pages customers see after a successful, failed or pending payment. All three are required.

Then add a Flutterwave block or shortcode to any page. Use test keys (`FLWPUBK_TEST-…`) and Flutterwave's [test cards](https://developer.flutterwave.com/docs/testing) to try it, and switch to live keys when you're ready.

You can change any setting later from the **General**, **API & Webhook**, **Payment Methods** and **Redirects** tabs.

> A form only appears once your API keys and all three redirect pages are saved. Until then, editors see a notice with a link to the missing setting, and visitors see nothing.

## Blocks

In the block editor, open the inserter and choose the **Flutterwave** category.

| Block | What it does |
| --- | --- |
| Payment Button | An email field and a pay button for a fixed amount, like "Pay NGN 5,000". Logged-in users can skip the email. |
| Payment Form | A full form with an optional heading and description, and a fixed amount or one the customer enters. Name and phone fields are optional. |
| Donation Form | One-off, monthly or yearly donations, with up to six suggested amounts. |
| Pricing Card | A plan or product card with a price, features, an optional badge and a checkout button. |
| Payment Methods | A badge listing the methods enabled in **Flutterwave > Settings**. |

Each block has its own accent colour, button text colour and corner radius under the block's **Styles** tab. Button text can include `{amount}`, which is replaced with the formatted price. Blocks are rendered on the server with the same code as the shortcodes.

## Shortcodes

Paste a shortcode into any page, post or widget, or use it in a page builder. **Flutterwave > Payment Forms** has a builder that writes the shortcode for you.

### Payment form

```
[flw-pay-form]
```

| Attribute | Example | What it does |
| --- | --- | --- |
| `amount` | `amount="5000"` | Fixed amount. Leave it out to let the customer enter one. |
| `currency` | `currency="NGN,USD,GBP"` | One currency, or several for the customer to choose from. Defaults to the currency in settings. |
| `heading`, `description` | `heading="Book a session"` | Text above the form. |
| `email` | `email="customer@example.com"` | Pre-fills the email. |
| `use_current_user_email` | `use_current_user_email="yes"` | Fills in the logged-in user's email. |
| `split_name` | `split_name="1"` | Separate first and last name fields. |
| `exclude` | `exclude="phone"` | Hides a field (`phone`, `fullname` or a custom field). |
| `custom_fields` | `custom_fields="age:number,size:select\|Small:S\|Large:L"` | Adds your own fields. |
| `order` | `order="email,fullname,amount,currency"` | Changes the field order. |
| `layout` | `layout="compact"` | No card around the form; fields and button sit on one line, like the Payment Button block. |
| `width` | `width="full"` | Fills the width of its container. |
| `show_secured` | `show_secured="0"` | Hides the "Secured by Flutterwave" line. |

Button text goes between the tags:

```
[flw-pay-form amount="5000" currency="NGN"]Pay {amount}[/flw-pay-form]
```

More examples:

```
[flw-pay-form amount="1234" currency="USD,UGX,NGN" custom_fields="age:number,color:select|black:#000|white:#fff" exclude="phone"]

[flw-pay-form amount="1234" currency="USD,UGX,NGN" order="currency,fullname,amount,phone,email"]
```

`[flw-pay-button]` from earlier versions still works and accepts the same attributes.

### Donation form

```
[flw-donation-form]
```

| Attribute | Example | What it does |
| --- | --- | --- |
| `heading`, `message` | `heading="Support our work"` | Text above the form. |
| `currency` | `currency="USD"` | The donation currency. |
| `amounts` | `amounts="1000,5000,10000"` | Up to six suggested amounts. |
| `show_frequency` | `show_frequency="0"` | One-off donations only. |

Monthly and yearly donations use a Flutterwave payment plan, which the plugin creates for you.

### Classic Editor and WPBakery

The Classic Editor has a Flutterwave toolbar button that inserts a payment shortcode. WPBakery Page Builder has a **Flutterwave Simple Form** element.

### Styling

Turn on the theme style option under **Payment Methods** in the settings to use your theme's form styles, or target `.flw-simple-pay-now-form` in your own CSS.

## Integrations

Go to **Flutterwave > Integrations**.

| Plugin | What you get |
| --- | --- |
| Easy Digital Downloads | Sell ebooks, software, music and other downloads, paid with Flutterwave at checkout. |
| GiveWP | Collect donations through GiveWP forms and campaigns. |
| WooCommerce | Install and activate the official Flutterwave WooCommerce extension in one click. |

Easy Digital Downloads and GiveWP payments use Flutterwave's hosted checkout. They're confirmed when the customer returns and again by webhook.

Coming soon: WPForms, Gravity Forms, Contact Form 7, Paid Memberships Pro, MemberPress, LearnDash, Tutor LMS and Event Tickets.

## Payments and reporting

- **Flutterwave > Transactions** lists every payment made through your forms. Filter by date range, status and currency, open a payment to check it again with Flutterwave or delete it, and download a CSV for a date range. The CSV is safe to open in a spreadsheet: values that could run as formulas are neutralised.
- **Flutterwave > Payment Forms** shows each form, the page it's on, whether the page is published, and how many successful payments it has taken in each currency.
- When in doubt about a payment, check your Flutterwave dashboard. It is always the final record.

## Security

- Customers enter payment details on Flutterwave's checkout, never on your site.
- The amount and currency of each form are signed on your server, so they can't be changed in the browser.
- Every payment is verified with Flutterwave against the stored transaction reference, amount and currency before it's marked successful.
- Webhooks are rejected unless a secret hash is configured, and the hash is compared in constant time.
- Secret keys are masked in the admin, settings are validated, and checkout requests are rate-limited (see the `flw_checkout_rate_limit` filter).
- Keep your API keys private, and use your own secret hash rather than sharing it.

## External services

The plugin connects to services run by Flutterwave Technology Solutions.

**Flutterwave payments API** (`api.flutterwave.com`) processes payments. When a customer submits a form, the plugin sends the amount, currency, the customer's email, name and phone number, and a transaction reference. It then asks the API to verify the payment when the customer returns or a webhook arrives. It also reads your account's transactions for the Transactions screen.

**Flutterwave integration analytics** (`signozservice-prod.f4b-flutterwave.com`) helps Flutterwave see whether integrations are working. The plugin sends:

- when your site is first set up: your public API key, the plugin name and version;
- when a payment starts: the transaction reference, whether you use test or live keys, and the plugin version;
- when a live payment succeeds: the transaction reference, amount, currency, fee and payment method;
- when something goes wrong: an error code and message, with the transaction reference where there is one.

No customer names, email addresses, phone numbers or card details are sent to the analytics service. To turn it off, add `define( 'FLW_DISABLE_TELEMETRY', true );` to `wp-config.php`, or return `false` from the `flw_signoz_enabled` filter.

Both services are covered by Flutterwave's [Terms of Service](https://flutterwave.com/us/terms) and [Privacy Notice](https://flutterwave.com/us/privacy-notice).

## Troubleshooting

- **The form doesn't show:** save your API keys and all three redirect pages under **Flutterwave > Settings**.
- **`authorization` or `validation` errors:** check that both keys are from the same mode (test or live) and were pasted in full.
- **Payments stay pending:** make sure the webhook URL and secret hash in your Flutterwave dashboard match the ones in **Flutterwave > Settings > API & Webhook**.
- **`server` errors:** contact support (below).

## Support

Email the developer experience team at [developers@flutterwavego.com](mailto:developers@flutterwavego.com), or [open an issue](https://github.com/Flutterwave/WordPress-v2/issues) on GitHub.

## Development

Requirements: PHP 7.4+, Composer, Node.js 24 (see `.nvmrc`) and Docker (for `wp-env`).

```bash
npm ci                 # installs npm and Composer dependencies
npm run env:start      # WordPress at http://localhost:8888 (admin / password)
```

| Command | What it runs |
| --- | --- |
| `npm run start` | Rebuild the admin app (`client/admin`) on every change |
| `npm run build:admin` | Build the admin app into `build/` once |
| `npm run test:js` | Vitest tests for the admin app (`client/**/test`) |
| `npm run test:unit` | Fast PHPUnit + Brain Monkey tests in `tests/Unit` (no WordPress needed) |
| `npm run test:integration` | PHPUnit against the WordPress test suite inside wp-env (`tests/Integration`) |
| `npm run test:e2e` | Playwright browser tests against the wp-env site (`tests/e2e`); run `npm run test:e2e:install` once first |
| `npm test` | All of the above |
| `npm run lint` | PHPCS (WordPress Coding Standards 3), ESLint and Stylelint |
| `npm run audit` | `npm audit` and `composer audit` |
| `npm run build` | Minified JS, translation template and `rave-payment-forms.zip` |

The onboarding wizard and settings screen are a React app in `client/admin`, built with `@wordpress/scripts` and mounted on **Flutterwave > Settings**. It reads and writes settings through the `flutterwave/v1/settings` REST route (`includes/admin`). `build/` is not committed, so run `npm run build:admin` before opening the settings page in a checkout of the repository.

Blocks live in `blocks/` (block.json and server render) and `client/blocks` (editor). Shortcodes are in `includes/shortcodes`, and the Easy Digital Downloads and GiveWP gateways are in `includes/integrations`.

CI (`.github/workflows/ci.yml`) runs linting, dependency audits, unit tests on PHP 7.4–8.5, integration tests on WordPress 6.4 and latest, and the end-to-end suite on every push and pull request.

Contributions are welcome: open an issue or a pull request on [GitHub](https://github.com/Flutterwave/WordPress-v2). See [CHANGELOG.md](CHANGELOG.md) for release notes.

## License

Released under the [MIT license](LICENSE). By contributing, you agree that your contributions will be licensed under it.

Copyright (c) Flutterwave Inc.
