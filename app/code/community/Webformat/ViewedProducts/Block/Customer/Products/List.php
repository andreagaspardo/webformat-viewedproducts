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
 * Webformat viewedproducts block account.
 */
class Webformat_ViewedProducts_Block_Customer_Products_List extends Mage_Core_Block_Template {
    /**
     * Get customer viewed product items.
     */
    public function getItems() {
        /* @var $collection Webformat_ViewedProducts_Model_Resource_ViewedProduct_Collection */
        $collection = Mage::getResourceModel("webformat_viewedproducts/viewedProduct_collection");

        /* @var $collection Webformat_ViewedProducts_Model_Resource_ViewedProduct_Collection */
        $collection = Mage::getModel("webformat_viewedproducts/viewedProduct")->getCollection();

        /* @var $session Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');

        if (!$session->isLoggedIn()) {
            return array();
        }
        return $collection->findByCustomer($session->getCustomer());
    }

    /**
     * Render product link
     * @param number $productId
     * @return string
     */
    public function renderProductLink($productId) {
        /* @var $product Mage_Catalog_Model_Product */
        $product = Mage::getModel("catalog/product")->load($productId);
        if (!$product->hasData('entity_id')) {
            return "";
        }
        /** @noinspection HtmlUnknownTarget */
        return sprintf("<a href=\"%s\">%s</a>", $product->getProductUrl(), $product->getName());
    }
    
    /**
     * Get Back url.
     */
    public function getBackUrl() {
        return $this->getUrl('/');
    }
}
