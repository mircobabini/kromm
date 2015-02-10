<?php
class Clients extends Entities{
	public static $entityname = 'client';
}
class Client extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}
