# Magelearn CheckoutPhoneValidator with International Telephone Input JS
This module was intitally developped to provide custom validation for phone number field in Shipping and Billing address form and Address book edit form at frontend.

I have also added some code to add additional class to telephone field with which you can add/modify css for different purpose.

After i found International Telephone Input JS https://intl-tel-input.com/ which is a Jquery Plugin for entering and validating international telephone numbers.

I have Integrate this jQuery plugin in this Magento2 module. Which adds a country code flag with phone extension prefix dropdown to billing and shipping address telephone field as well as customer edit address book from My Account.

This module also Detects the user's country based on ip and preselect that country flag.

# Improvements

This module needs some improvement regarding with Phone number validation.

  1. Validating the phone number as per the country code flag selected and its Pattern.
  (https://intl-tel-input.com/node_modules/intl-tel-input/examples/gen/is-valid-number.html)

You can also save this country flag code and prefix Phone number and save it. After that you can display on Address information on Frontend.
