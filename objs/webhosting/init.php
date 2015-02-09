<?php
class Webhostings extends Entities{
	public static $entityname = 'webhosting';
}
class Webhosting extends Entity{
	public function __construct( $data ){
		parent::__construct( $data );
	}
}

function webhostings(){ return Webhostings::instance(); }
Webhosting::$tablename = webhostings()->tablename();
