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

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();


$table = "webformat_viewedproducts/viewedProduct";
$tableName = $installer->getTable($table);

$newTable = $installer->getConnection()->newTable($tableName)
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
        ), 'Entity Id')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
        ), 'Customer Id')
        ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
        ), 'Product Id')
        ->addColumn('visit_count', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false
        ), 'Visit count')
        ->addColumn('first_visited_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            'nullable'  => false
        ), 'First visited at')
        ->addColumn('last_visited_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            'nullable' => true
        ), 'Last visited at')
        ->addForeignKey($installer->getFkName('webformat_viewedproducts/viewedProduct', 'customer_id', 'customer/entity', 'entity_id'),
            'customer_id', $installer->getTable('customer/entity'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addForeignKey($installer->getFkName('webformat_viewedproducts/viewedProduct', 'product_id', 'catalog/product', 'entity_id'),
            'product_id', $installer->getTable('catalog/product'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->setComment("Viewed products");

$installer->getConnection()->createTable($newTable);

$installer->getConnection()
    ->addKey($tableName,
        $installer->getIdxName('IDX_PRODUCT', array('product_id', 'customer_id'),
                Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
        array('product_id', 'customer_id'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    );


$tableTest = "webformat_viewedproducts/test";
$tableNameTest = $installer->getTable($tableTest);

$newTableTest = $installer->getConnection()->newTable($tableNameTest)
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
        ), 'Test Id')
        ->addColumn('label', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32, array(
            'nullable' => true,
        ), 'Label')
        ->setComment("Test table");

$installer->getConnection()->createTable($newTableTest);

$installer->endSetup();
