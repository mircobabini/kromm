<?php
class Clients extends Entities{
	public static $entityname = 'client';
}
class Client extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}

function clients(){ return Clients::instance(); }
Client::$tablename = clients()->tablename();
