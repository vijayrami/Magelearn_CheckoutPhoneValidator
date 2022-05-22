var config = {
	map: {
	    '*': {
	        "intlTelInput": 'Magelearn_CheckoutPhoneValidator/js/intlTelInput',
	    }
	},
	paths: {
	    "intlTelInput": 'Magelearn_CheckoutPhoneValidator/js/intlTelInput',
	    "intlTelInputUtils": 'Magelearn_CheckoutPhoneValidator/js/utils',
	},
	shim: {
        'intlTelInput': {
            'deps':['jquery', 'knockout']
        }
    },
    config: {
        mixins: {
            'Magento_Ui/js/lib/validation/validator': {
                'Magelearn_CheckoutPhoneValidator/js/validator-mixin': true
            }
        }
    }
};