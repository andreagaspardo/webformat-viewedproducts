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
 * @method Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_View_Form setTitle($title);
 */
class Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_View_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Construct the block.
     */
    public function __construct() {
        $this->setId('block_form');
        $this->setTitle(Mage::helper('webformat_viewedproducts')->__('Record information'));

        parent::__construct();
    }

    /**
     * Prepare form.
     */
    protected function _prepareForm() {
        $model = Mage::registry('_current_viewedProduct');

        $form = new Varien_Data_Form(
            array('id' => 'view_form')
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset',
                array('legend' => Mage::helper('webformat_viewedproducts')->__('General Information'),
                    'class' => 'fieldset-narrow'));

        if ($model->getBlockId()) {
            $fieldset->addField('block_id', 'hidden', array(
                'name' => 'block_id',
            ));
        }

        $fieldset->addField('entity_id', 'text', array(
            'name'      => 'entity_id',
            'label'     => Mage::helper('webformat_viewedproducts')->__('ID'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('ID'),
            'disabled'  => true
        ));
        $fieldset->addField('customer_name', 'text', array(
            'name'      => 'customer_name',
            'label'     => Mage::helper('webformat_viewedproducts')->__('Customer'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('Customer'),
            'disabled'  => true
        ));
        $fieldset->addField('product_name', 'text', array(
            'name'      => 'product_name',
            'label'     => Mage::helper('webformat_viewedproducts')->__('Product'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('Product'),
            'disabled'  => true
        ));
        $fieldset->addField('visit_count', 'text', array(
            'name'      => 'visit_count',
            'label'     => Mage::helper('webformat_viewedproducts')->__('Visit count'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('Visit count'),
            'disabled'  => true
        ));
        $fieldset->addField('first_visited_at', 'text', array(
            'name'      => 'first_visited_at',
            'label'     => Mage::helper('webformat_viewedproducts')->__('First visited at'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('First visited at'),
            'disabled'  => true
        ));
        $fieldset->addField('last_visited_at', 'text', array(
            'name'      => 'last_visited_at',
            'label'     => Mage::helper('webformat_viewedproducts')->__('Last visited at'),
            'title'     => Mage::helper('webformat_viewedproducts')->__('Last visited at'),
            'disabled'  => true
        ));
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();

    }
}
