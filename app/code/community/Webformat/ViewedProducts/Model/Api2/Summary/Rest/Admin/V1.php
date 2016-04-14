<?php

/**
 * Created by PhpStorm.
 * User: andreag
 * Date: 13/04/16
 * Time: 11.11
 */
class Webformat_ViewedProducts_Model_Api2_Summary_Rest_Admin_V1 extends Webformat_ViewedProducts_Model_Api2_Summary
{
    public function _retrieve()
    {
        return array('viewed_products' => $this->getSum());
    }

    public function getSum() {
        $collection = Mage::getModel('webformat_viewedproducts/viewedProduct')
            ->getCollection();
        $collection->getSelect()->columns('sum(visit_count) as s');
        foreach ($collection as $item) {
            return $item->getS();
        }
    }
}