<?php
/**
 * Copyright (C) 2016 Webformat S.r.l.
 * http://www.webformat.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
?>
<?php

/**
 * Webformat Viewed products helper.
 */
class Webformat_ViewedProducts_Helper_Data extends Mage_Core_Helper_Abstract {
    /**
     * Check data from cron.
     */
    public function checkData() {
        Mage::log("Checking for data", null, "webformat.log", true);
        // ...
        Mage::log("Done", null, "webformat.log", true);
    }

    /**
     * Register visit.
     * @param Mage_Catalog_Model_Product $product
     * @param Mage_Customer_Model_Customer $customer
     */
    public function registerEvent(Mage_Catalog_Model_Product $product,
            Mage_Customer_Model_Customer $customer) {
        /* @var $resource Webformat_ViewedProducts_Model_Resource_ViewedProduct */
        $resource = Mage::getResourceModel("webformat_viewedproducts/viewedProduct");
        $resource->registerEvent($product, $customer);
    }
}
