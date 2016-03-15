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
 * Observe product viewes.
 */
class Webformat_ViewedProducts_Model_Catalog_Product_View_Observer extends Mage_Core_Model_Abstract {
    /**
     * A product has been viewed.
     * @param Varien_Event_Observer $observer
     */
    public function productViewed(Varien_Event_Observer $observer) {
        try {
            /* @var $product Mage_Catalog_Model_Product */
            $product = $observer->getProduct();
            if (!($product instanceof Mage_Catalog_Model_Product)) {
                return;
            }
            /* @var $session Mage_Customer_Model_Session */
            $session = Mage::getSingleton('customer/session');

            if (!$session->isLoggedIn()) {
                return;
            }
            $this->registerEvent($product, $session->getCustomer());
        } catch (Exception $e) {
            Mage::log($e->getMessage());
        }
    }

    /**
     * Register visit.
     * @param Mage_Catalog_Model_Product $product
     * @param Mage_Customer_Model_Customer $customer
     */
    public function registerEvent(Mage_Catalog_Model_Product $product,
            Mage_Customer_Model_Customer $customer) {
        /* @var $helper Webformat_ViewedProducts_Helper_Data */
        $helper = Mage::helper('webformat_viewedproducts');
        $helper->registerEvent($product, $customer);
    }
}
