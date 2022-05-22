# Magelearn CheckoutPhoneValidator with International Telephone Input JS
This module was intitally developped to provide custom validation for phone number field in Shipping and Billing address form and Address book edit form at frontend.

I have also added some code to add additional class to telephone field with which you can add/modify css for different purpose.

After i found International Telephone Input JS https://intl-tel-input.com/ which is a Jquery Plugin for entering and validating international telephone numbers.

I have Integrate this jQuery plugin in this Magento2 module. Which adds a country code flag with phone extension prefix dropdown to billing and shipping address telephone field.

# Improvements
Currently at the moment this module only have the ability to display coutry flag dropdown in Telephone field for both shipping and biliing address form.
But this Jquery Plugins have more enhanced features which needed to implement:

  1. Detects the user's country and preselect that country flag.
  2. Displays a relevant placeholder according to phone number patterns and provides formatting/validation methods according to it.

You can also save this country flag code and prefix Phone number and save it. After that you can display on Address information on Frontend.
