<?php
namespace Magelearn\CheckoutPhoneValidator\Model;

use Magento\Framework\Serialize\Serializer\Json;
use Magelearn\CheckoutPhoneValidator\Helper\Data;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Checkout\Model\Session as CheckoutSession;

class DefaultConfigProviderPlugin
{
    /**
     * @var Json
     */
    private $jsonHelper;
    
    /**
     * @var CountryInformationAcquirerInterface
     */
    private $countryInformation;

    /**
     * @var Data
     */
    private $helper;
    
    /**
     *
     * @var CheckoutSession
     */
    private $checkoutSession;
    
    /**
     * DefaultConfigProviderPlugin constructor.
     * @param \Magento\Framework\Serialize\Serializer\Json $jsonHelper
     * @param \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformation
     * @param \Magelearn\CheckoutPhoneValidator\Helper\Data $helper
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        Json $jsonHelper,
        CountryInformationAcquirerInterface $countryInformation,
        Data $helper,
        CheckoutSession $checkoutSession
    )
    {
        $this->jsonHelper = $jsonHelper;
        $this->countryInformation = $countryInformation;
        $this->helper = $helper;
        $this->checkoutSession = $checkoutSession;
    }

    public function afterGetConfig(\Magento\Checkout\Model\DefaultConfigProvider $config, $output)
    {
        $output = $this->getPhoneConfig($output);
        return $output;
    }

    /**
     * @return bool|string
     */
    private function getPhoneConfig($output)
    {
        $output['intl_tel_config_option']['preferred_countries'] = [strtolower($this->helper->preferedCountry())];
        
        if ($this->helper->allowedCountries()) {
            $output['intl_tel_config_option']['only_countries'] = explode(",", strtolower($this->helper->allowedCountries()));
        }
        return $output;
    }
}