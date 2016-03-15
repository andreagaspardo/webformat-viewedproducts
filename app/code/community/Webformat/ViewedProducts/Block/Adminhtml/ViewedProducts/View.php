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
 * Webformat viewedproducts block adminhtml viewedproducts form container.
 */
class Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_View extends Mage_Adminhtml_Block_Widget_Form_Container {

    /**
     * Construct the block.
     */
    public function __construct() {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'webformat_viewedproducts';
        $this->_controller = 'adminhtml_viewedProducts';
        $this->_mode = 'view';
        parent::__construct();
        $this->removeButton('save');
        $this->removeButton('reset');
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText() {
        /* @var $product Varien_Object */
        $product = Mage::registry('_current_viewedProduct');
        return Mage::helper('webformat_viewedproducts')
                ->__('Viewed product record details (id %d)', $product->getData('entity_id'));
    }
}
