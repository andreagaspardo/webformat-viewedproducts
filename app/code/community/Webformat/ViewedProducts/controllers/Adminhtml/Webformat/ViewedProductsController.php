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
 * Viewed products controller.
 */
class Webformat_ViewedProducts_Adminhtml_Webformat_ViewedProductsController extends Mage_Adminhtml_Controller_Action {

	/**  Index. */
	public function indexAction() {
		$this->_title($this->__('Viewed products'));
		$this->loadLayout()->_setActiveMenu('customer/webformat_viewedproducts');
		return $this->renderLayout();
	}

	/**  Grid action (Ajax). */
	public function gridAction() {
		return $this->loadLayout(false)->renderLayout();
	}

    /**  View single record action. */
	public function viewAction() {
        $model = Mage::getModel('webformat_viewedproducts/viewedProduct');
        $id = $this->getRequest()->getParam('id');
        if (!$id) {
            $this->_forward('noRoute');
            return $this;
        }
        $model->load($id);
        if (!$model->hasData('entity_id')) {
            $this->_forward('noRoute');
            return $this;
        }

        Mage::register('_current_viewedProduct', $model);

		$this->_title($this->__('Viewed products'));
		$this->loadLayout()->_setActiveMenu('customer/webformat_viewedproducts');

        $breadcrumbTitle = Mage::helper('webformat_viewedproducts')->__('Viewed product record details');
        $breadcrumbLabel = $breadcrumbTitle;

        $this->_title($model->getProductName());
        $this->_addBreadcrumb($breadcrumbLabel, $breadcrumbTitle);

       
		return $this->loadLayout()->renderLayout();
	}
}
