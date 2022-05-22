<?php
namespace Magelearn\CheckoutPhoneValidator\Model;

use Magento\Framework\Serialize\Serializer\Json;
use Magelearn\CheckoutPhoneValidator\Helper\Data;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\View\Asset\Repository;

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
    
    private $_assetRepo;
    
    /**
     * DefaultConfigProviderPlugin constructor.
     * @param \Magento\Framework\Serialize\Serializer\Json $jsonHelper
     * @param \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformation
     * @param \Magelearn\CheckoutPhoneValidator\Helper\Data $helper
     * @param CheckoutSession $checkoutSession
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     */
    public function __construct(
        Json $jsonHelper,
        CountryInformationAcquirerInterface $countryInformation,
        Data $helper,
        CheckoutSession $checkoutSession,
        \Magento\Framework\View\Asset\Repository $assetRepo
    )
    {
        $this->jsonHelper = $jsonHelper;
        $this->countryInformation = $countryInformation;
        $this->helper = $helper;
        $this->checkoutSession = $checkoutSession;
        $this->_assetRepo = $assetRepo;
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
        $config  = [          
                "nationalMode" => false,
                "utilsScript" => $this->_assetRepo->getUrl("Magelearn_CheckoutPhoneValidator::js/utils.js"),
                "preferredCountries" => [$this->helper->preferedCountry()]
        ];
        
        if ($this->helper->allowedCountries()) {
            $config["onlyCountries"] = explode(",", $this->helper->allowedCountries());
        }
        
        $output['intl_tel_config_option'] = $this->jsonHelper->serialize($config);
        
        return $output;
    }
}