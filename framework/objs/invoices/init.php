<?php
class Invoices extends Entities{
	public static $entityname = 'invoice';
}
class Invoice extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}
