<?php
class Products extends Entities{
	public static $entityname = 'product';
}
class Product extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}
