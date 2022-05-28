<?php

namespace Magelearn\CheckoutPhoneValidator\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magelearn\CheckoutPhoneValidator\Helper\Data;
use Magento\Directory\Api\CountryInformationAcquirerInterface;

class PhoneNumber extends Template
{

    /**
     * @var Json
     */
    protected $jsonHelper;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var CountryInformationAcquirerInterface
     */
    protected $countryInformation;

    /**
     * PhoneNumber constructor.
     * @param Context $context
     * @param Json $jsonHelper
     */
    public function __construct(
        Context $context,
        Json $jsonHelper,
        CountryInformationAcquirerInterface $countryInformation,
        Data $helper
    )
    {
        $this->jsonHelper = $jsonHelper;
        $this->helper = $helper;
        $this->countryInformation = $countryInformation;
        parent::__construct($context);
    }

    public function phonePrefferedCountryConfig()
    {
        $preffered_country = [strtolower($this->helper->preferedCountry())];

        return $this->jsonHelper->serialize($preffered_country);
    }
    
    public function phoneOnlyCountryConfig()
    {
        $onlycountry = array();
        
        if ($this->helper->allowedCountries()) {
            $onlycountry = explode(",", strtolower($this->helper->allowedCountries()));
        }
        return $this->jsonHelper->serialize($onlycountry);
    }
}