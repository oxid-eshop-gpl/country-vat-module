<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

class countryvat__oxuser extends countryvat__oxuser_parent
{
    /**
     * Returns country id which VAT should be applied to.
     * Depending on configuration option either user billing country or shipping country (if available) is returned.
     *
     * @return string
     */
    public function getVatCountry()
    {
        $blUseShippingCountry = $this->getConfig()->getConfigParam("blShippingCountryVat");

        if ($blUseShippingCountry) {
            $addresses = $this->getUserAddresses($this->getId());
            $selectedAddress = $this->getSelectedAddressId();

            if (isset($addresses[$selectedAddress])) {
                return $addresses[$selectedAddress]->getFieldData('oxcountryid');
            }
        }

        return $this->getFieldData('oxcountryid');
    }
}