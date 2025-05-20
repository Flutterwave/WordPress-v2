## Activate

```
start_path: /wp-admin/plugins.php?plugin_status=search&s=rave-payment-forms
```

If you have activated the plugin skip this step.

### Click Activate under Flutterwave Payments plugin.

I see **Plugin activated** notice. On the sidbar you should see the flutterwave logo. On hovering the logo two submenus should be displayed. **Settings** and **Transactions**.

## Settings up Flutterwave Payments.

Click on **Settings** and add the required details.  API keys and redirect urls are a must to ensure users get the very best experience.

1.  Fill the Test Public Key text field.
2.  Fill the Test Secret Key text field.
3.  Fill the success redirect url text field.
4.  Fill the failed redirect url text field.

### Testing Payment Shortcodes.

Currently there are two shortcodes `flw-pay-button` and `flw-donation-form`

1. Create a WordPress page.
2. Add a shortcode block.
3. Enter the shortcode **[flw-pay-button]** or **[flw-donation-form]**
4. save the changes and publish the page.

On visiting the page, i see a form with the following fields `email`, `first_name`, `last_name`, `currency`.



