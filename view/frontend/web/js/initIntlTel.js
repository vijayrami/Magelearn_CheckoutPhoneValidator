define(
    [
        'jquery',
		'Magelearn_CheckoutPhoneValidator/js/utils',
		'intlTelInput'
    ],
    function ($, utiljs) {
        return function () {
			var intl_only_countries = window.checkoutConfig.intl_tel_config_option['only_countries'];
			var intl_preferred_countries = window.checkoutConfig.intl_tel_config_option['preferred_countries'];
			//console.log(intl_phone_config_option);
			var shipping_telephone_input = document.querySelector(".shipping-telephone-input");
			var billing_telephone_input = document.querySelectorAll(".billing-telephone-input");
			
			const intl_phone_config_option = {
			  nationalMode: false,
			  initialCountry: "auto",
			  onlyCountries: intl_only_countries,
			  preferredCountries: intl_preferred_countries,
			  geoIpLookup: function(callback) {
			    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
			      var countryCode = (resp && resp.country) ? resp.country : "us";
			      callback(countryCode);
			    });
			  },
			  utilsScript: utiljs // just for formatting/placeholders etc
			};
			
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
