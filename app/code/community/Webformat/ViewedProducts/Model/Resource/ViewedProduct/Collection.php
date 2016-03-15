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
 * Table resource.
 */
class Webformat_ViewedProducts_Model_Resource_ViewedProduct_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    /**
     * Construct.
     */
    public function _construct() {
        $this->_init("webformat_viewedproducts/viewedProduct");
    }

    /**
     * Find record by customer and product.
     * @param Mage_Catalog_Model_Product $product
     * @param Mage_Customer_Model_Customer $customer
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function findByCustomerAndProduct(Mage_Catalog_Model_Product $product,
            Mage_Customer_Model_Customer $customer) {
        return $this->addFieldToFilter("customer_id", $customer->getEntityId())
                ->addFieldToFilter("product_id", $product->getEntityId());
    }

    /**
     * Find record by customer.
     * @param Mage_Customer_Model_Customer $customer
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function findByCustomer(Mage_Customer_Model_Customer $customer) {
        return $this->addFieldToFilter("customer_id", $customer->getEntityId());
    }
}
