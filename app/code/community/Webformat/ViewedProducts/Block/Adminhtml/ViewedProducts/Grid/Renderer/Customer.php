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
 * Webformat viewedproducts block adminhtml viewedproducts grid renderer customer.
 */
class Webformat_ViewedProducts_Block_Adminhtml_ViewedProducts_Grid_Renderer_Customer
        extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    /**
     * Renders grid column
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row) {
        /* @var $customer Mage_Customer_Model_Customer */
        $customer = Mage::getModel('customer/customer')->load($row->getData('customer_id'));
        /** @noinspection HtmlUnknownTarget */
        return sprintf('<a href="%s">%s</a>',
                $this->getUrl('adminhtml/customer/edit', array('id' => $customer->getEntityId())),
                $customer->getName());
    }
}
