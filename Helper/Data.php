<?php

namespace Magelearn\CheckoutPhoneValidator\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{

    const XML_PATH_INTERNATIONAL_TELEPHONE_INPUT_MODULE_ENABLED = 'internationaltelephoneinput/general/enabled';

    const XML_PATH_INTERNATIONAL_TELEPHONE_MULTISELECT_COUNTRIES_ALLOWED = 'internationaltelephoneinput/general/allow';

    const XML_PATH_PREFERED_COUNTRY = 'general/store_information/country_id';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {
        return $this->getConfig(self::XML_PATH_INTERNATIONAL_TELEPHONE_INPUT_MODULE_ENABLED);
    }

    /**
     * @return mixed
     */
    public function allowedCountries()
    {
        return $this->getConfig(self::XML_PATH_INTERNATIONAL_TELEPHONE_MULTISELECT_COUNTRIES_ALLOWED);
    }

    /**
     * @return mixed
     */
    public function preferedCountry()
    {
        return $this->getConfig(self::XML_PATH_PREFERED_COUNTRY);
    }

    /**
     * @param $configPath
     * @return mixed
     */
    protected function getConfig($configPath)
    {
        return $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getId());
    }
    
    /**
     * Prepare telephone field config according to the Magento default config
     * @param $addressType
     * @param string $method
     * @return array
     */
    public function telephoneFieldConfig($addressType, $method = '')
    {
        return  [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => $addressType . $method,
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'Magelearn_CheckoutPhoneValidator/form/element/billing_phone_template',
                'tooltip' => [
                    'description' => 'For delivery questions.',
                    'tooltipTpl' => 'ui/form/element/helper/tooltip'
                ],
            ],
            'dataScope' => $addressType . $method . '.telephone',
            'dataScopePrefix' => $addressType . $method,
            'label' => __('Phone Number'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 120,
            'validation' => [
                "required-entry"    => true,
                "custom-validate-telephone" => true,
                "max_text_length"   => 255,
                "min_text_length"   => 1
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'focused' => false,
        ];
    }
}