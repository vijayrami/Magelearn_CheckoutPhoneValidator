define(
    [
        'jquery',
		'intlTelInput'
    ],
    function ($) {
        return function () {
			var intl_phone_config_option = window.checkoutConfig.intl_tel_config_option;
			//console.log(intl_phone_config_option);
			var shipping_telephone_input = document.querySelector(".shipping-telephone-input");
			var billing_telephone_input = document.querySelectorAll(".billing-telephone-input");
			
			if(shipping_telephone_input) {
				window.intlTelInput(shipping_telephone_input, intl_phone_config_option);
			}
		    if(billing_telephone_input) {
		    	billing_telephone_input.forEach(function(intlTelItem) {
		    		window.intlTelInput(intlTelItem, intl_phone_config_option);
	    		});

		    }
        };
    }
);
