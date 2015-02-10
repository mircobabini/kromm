<?php
class Domains extends Entities{
	public static $entityname = 'domain';
}
class Domain extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}

