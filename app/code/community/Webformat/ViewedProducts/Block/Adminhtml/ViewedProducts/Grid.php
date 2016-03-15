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
 * Webformat viewedproducts block adminhtml viewedproducts grid.
 * @method Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_Grid setUseAjax($value)
 */
class Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    /**
     * Construct the block.
     * @param array $attributes
     */
    public function __construct($attributes = array()) {
        parent::__construct($attributes);
        $this->setId('entity_id');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Setting collection to show
     * 
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection() {
        /* @var $collection Webformat_ViewedProducts_Model_Resource_ViewedProduct_Collection */
        $collection = Mage::getModel('webformat_viewedproducts/viewedProduct')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('entity_id', array(
            'header' => $this->__('Id'),
            'align' => 'left',
            'index' => 'entity_id',
            'width' => 1,
            'type' => 'range'
        ));

        $this->addColumn('customer_id', array(
            'header' => $this->__('Customer'),
            'index' => 'customer_id',
            'renderer' => 'webformat_viewedproducts/adminhtml_viewedProducts_grid_renderer_customer',
        ));
        $this->addColumn('product_id', array(
            'header' => $this->__('Product'),
            'index' => 'product_id',
            'renderer' => 'webformat_viewedproducts/adminhtml_viewedProducts_grid_renderer_product',
        ));
        $this->addColumn('visit_count', array(
            'header' => $this->__('Visit count'),
            'index' => 'visit_count',
            'width' => 1,
        ));
        $this->addColumn('first_visited_at', array(
            'header' => $this->__('First visited at'),
            'index' => 'first_visited_at',
            'width' => 150,
        ));
        $this->addColumn('last_visited_at', array(
            'header' => $this->__('Last visited at'),
            'index' => 'last_visited_at',
            'width' => 150,
        ));

    }

    /**
     * Get grid url.
     */
    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * No row url.
     * @param Varien_Object $item
     * @return string
     */
    public function getRowUrl(Varien_Object $item) {
        return $this->getUrl('*/*/view', array('id' => $item->getData('entity_id')));
    }
}
