<?php
/**
 * Setup scripts, add new column and fulfills
 * its values to existing rows
 *
 */
/* @var $this Mage_Sales_Model_Mysql4_Setup */
$this->startSetup();

	// Add telephone
	$this->getConnection()->addColumn(
	$this->getTable('sales/order_grid'),
		'customer_telephone',
		"varchar(255) not null default ''"
	);
	
	$this->getConnection()->addKey(
	$this->getTable('sales/order_grid'),
		'customer_telephone',
		'customer_telephone'
	);
	 
	$select = $this->getConnection()->select();
	$select->join(
		array('address'=>$this->getTable('sales/order_address')),
			$this->getConnection()->quoteInto(
			'address.parent_id = order_grid.entity_id AND address.address_type = ?',
			Mage_Sales_Model_Quote_Address::TYPE_BILLING
		),
		array('customer_telephone' => 'telephone')
	);
	 
	$this->getConnection()->query(
		$select->crossUpdateFromSelect(
			array('order_grid' => $this->getTable('sales/order_grid'))
		)
	);

$this->endSetup();