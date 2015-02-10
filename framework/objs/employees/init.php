<?php
class Employees extends Entities{
	public static $entityname = 'employee';
}
class Employee extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}

