<?php

namespace Magelearn\CheckoutPhoneValidator\Block\Checkout;

use Magelearn\CheckoutPhoneValidator\Helper\Data;

class LayoutProcessor
{
    /**
     * @var Data
     */
    protected $helper;
    
    /**
     * LayoutProcessor constructor.
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }
    
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
            if (!$this->helper->isModuleEnabled()) {
                return $jsLayout;
            }
        
            /*For shipping address form*/
            
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['telephone']['validation']['custom-validate-telephone'] = true;
            
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['telephone']['config']['elementTmpl'] = 'Magelearn_CheckoutPhoneValidator/form/element/shipping_phone_template';
            
            /* config: checkout/options/display_billing_address_on = payment_method */
            if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children']
                )) {
                    
                    foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                        ['payment']['children']['payments-list']['children'] as $key => $payment) {
                            
                            $method = substr($key, 0, -5);
                            
                            /* telephone */
                            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                            ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                            ['telephone'] = $this->helper->telephoneFieldConfig("billingAddress", $method);
                        }
                }
                
                /* config: checkout/options/display_billing_address_on = payment_page */
                if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['afterMethods']['children']['billing-address-form']
                    )) {
                        
                        $method = 'shared';
                        
                        /* telephone */
                        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                        ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                        ['telephone'] = $this->helper->telephoneFieldConfig("billingAddress", $method);
                    }
          
        return $jsLayout;
    }
}