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
 * Webformat Cron model.
 */
class Webformat_ViewedProducts_Model_Cron extends Mage_Core_Model_Abstract {
    /**
     * Check data from cron.
     */
    public function checkData() {
        /* @var $helper Webformat_ViewedProducts_Helper_Data */
        $helper = Mage::helper('webformat_viewedproducts');
        $helper->checkData();
    }
}
