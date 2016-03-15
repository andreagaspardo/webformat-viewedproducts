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
class Webformat_ViewedProducts_Model_Resource_ViewedProduct extends Mage_Core_Model_Resource_Db_Abstract {

    /**
     * Construct.
     */
    public function _construct() {
        $this->_init("webformat_viewedproducts/viewedProduct", "entity_id");
    }

    /**
     * Register visit.
     * @param Mage_Catalog_Model_Product $product
     * @param Mage_Customer_Model_Customer $customer
     */
    public function registerEvent(Mage_Catalog_Model_Product $product,
            Mage_Customer_Model_Customer $customer) {
        /* @var $model Webformat_ViewedProducts_Model_ViewedProduct */
        $model = Mage::getModel('webformat_viewedproducts/viewedProduct');

        if (!$model = $model->findByCustomerAndProduct($product, $customer)) {
            $model = Mage::getModel('webformat_viewedproducts/viewedProduct');
            $model->setCustomerId($customer->getEntityId());
            $model->setProductId($product->getEntityId());
        }
        $dt = Mage::getModel('core/date')->gmtDate();
        $model->setLastVisitedAt($dt);
        $model->incVisitCount();

        $model->save();
    }
}
