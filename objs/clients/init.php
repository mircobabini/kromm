<?php
class Clients extends Entities{
	public static $tablename = 'clients';
}
class Client extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}

function clients(){ return Clients::instance(); }
function client($data){ return new Client($data); }
Client::$tablename = clients()->tablename();
