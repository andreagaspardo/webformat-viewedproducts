<?php
/**
 * Created by PhpStorm.
 * User: andreag
 * Date: 17/03/16
 * Time: 16.03
 */

class Webformat_ViewedProducts_Block_Test extends Mage_Core_Block_Template
{
    public function getHelperData() {
        return $this->helper('webformat_viewedproducts')->getHelperData();
    }
}