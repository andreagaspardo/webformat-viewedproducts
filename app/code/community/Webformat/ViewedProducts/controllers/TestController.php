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
 * Test frontend controller.
 */
class Webformat_ViewedProducts_TestController extends Mage_Core_Controller_Front_Action
{
    /**
     * Display customer viewed products.
     */
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
        return;
        echo '<pre>';
        $model = Mage::getModel("webformat_viewedproducts/viewedProduct");
        echo get_class($model) . PHP_EOL;

        $resource = Mage::getResourceModel("webformat_viewedproducts/viewedProduct");
        echo get_class($resource) . PHP_EOL;

        $resource2 = Mage::getModel("webformat_viewedproducts/resource_viewedProduct");
        echo get_class($resource2) . PHP_EOL;

        $resource3 = Mage::getModel("webformat_viewedproducts/viewedProduct")->getResource();
        echo get_class($resource3) . PHP_EOL;

        $collection = Mage::getResourceModel("webformat_viewedproducts/viewedProduct_collection");
        echo get_class($collection) . PHP_EOL;

        $collection2 = Mage::getModel("webformat_viewedproducts/viewedProduct")->getCollection();
        echo get_class($collection2) . PHP_EOL;

        // Gets the collection instance
        $collection = Mage::getModel("webformat_viewedproducts/viewedProduct")->getCollection();
        $collection->addFieldToFilter("entity_id", array("gt" => 2));
        echo $collection->getSelect()->assemble() . PHP_EOL;

        foreach ($collection as $item) {
            echo get_class($item) . "\n";
        }
        echo '</pre>';
    }
}
