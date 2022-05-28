<?php
namespace Magelearn\CheckoutPhoneValidator\Model\Plugin;

class AttributeMergerPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\AttributeMerger $subject
     * @param array $result
     * @return array
     */
    public function afterMerge(
        \Magento\Checkout\Block\Checkout\AttributeMerger $subject,
        array  $result
    ) {
        if (array_key_exists('telephone', $result)) {
            $result['telephone']['additionalClasses'] = 'validate_telephone_number';
        }
        return $result;
    }
}