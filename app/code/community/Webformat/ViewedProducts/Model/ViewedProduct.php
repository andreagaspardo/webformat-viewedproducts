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
 * Webformat Viewed Products table model.
 */

/**
 * @method int getEntityId()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setEntityId(int $value)
 * @method int getCustomerId()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setCustomerId(int $value)
 * @method int getProductId()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setProductId(int $value)
 * @method int getVisitCount()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setVisitCount(int $value)
 * @method string getFirstVisitedAt()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setFirstVisitedAt(string $value)
 * @method string getLastVisitedAt()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setLastVisitedAt(string $value)
 * @method string getProductName()
 * @method Webformat_ViewedProducts_Model_ViewedProduct setProductName(string $value)
 *
 * @method bool hasEntityId()
 * @method bool hasCustomerId()
 * @method bool hasProductId()
 * @method bool hasVisitCount()
 * @method bool hasFirstVisitedAt()
 * @method bool hasLastVisitedAt()
 * @method bool hasProductName()
 */
class Webformat_ViewedProducts_Model_ViewedProduct extends Mage_Core_Model_Abstract {
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
     * @return bool
     */
    public function findByCustomerAndProduct(Mage_Catalog_Model_Product $product,
            Mage_Customer_Model_Customer $customer) {
        /* @var $collection Webformat_ViewedProducts_Model_Resource_ViewedProduct_Collection */
        $collection = $this->getCollection();
        $collection->findByCustomerAndProduct($product, $customer);
        if ($collection->count() === 0) {
            return false;
        }
        foreach ($collection as $item) {
            return $item;
        }
        return false;
    }

    /**
     * Standard model initialization
     *
     * @param string $resourceModel
     * @return Mage_Core_Model_Abstract
     */
    protected function _init($resourceModel) {
        parent::_init($resourceModel);
        $dt = Mage::getModel('core/date')->gmtDate();
        $this->setFirstVisitedAt($dt);
        $this->setLastVisitedAt($dt);
        $this->setVisitCount(0);
    }

    public function load($id, $field = null) {
        parent::load($id, $field);
        if ($this->hasCustomerId()) {
            $customer = Mage::getModel('customer/customer')->load($this->getCustomerId());
            if ($customer->hasData('entity_id')) {
                $this->setData('customer_name', $customer->getName());
            }
        }
        if ($this->hasProductId()) {
            $product = Mage::getModel('catalog/product')->load($this->getProductId());
            if ($product->hasData('entity_id')) {
                $this->setData('product_name', $product->getName());
            }
        }
    }
    
    /**
     * Increase visit count by one.
     */
    public function incVisitCount() {
        if ($this->hasVisitCount()) {
            $this->setVisitCount($this->getVisitCount() + 1);
        } else {
            $this->setVisitCount(1);
        }
    }
}
