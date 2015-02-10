<?php
require 'vendor/autoload.php';

define( 'DIR_ROOT', dirname(__FILE__) );
define( 'DIR_FW', DIR_ROOT.'/framework' );

define( 'DIR_CTRS', DIR_FW.'/ctrs' );
define( 'DIR_LIBS', DIR_FW.'/libs' );
define( 'DIR_OBJS', DIR_FW.'/objs' );

require DIR_FW.'/utils.php';
require DIR_LIBS.'/entities.php';

// init database
global $database;
$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'crm',
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'mysql',
]);

// init controllers
$entities = [ 'clients' ];
foreach( $entities as $entity ){
	require_once DIR_OBJS.'/'.$entity.'/init.php';
}

// init router
global $klein;
$klein = new \Klein\Klein();

// routes
$klein->respond('GET', '/api/clients', function(){
	$data = new StdClass();
	// $data->aaData = clients()->select( '*' );
	$data->aaData = [
		array(
			'name' => 'test',
			'attr1' => '1',
			'attr2' => '2',
			'attr3' => '3',
			'attr4' => '4',
		)
	];
	
	send_json( $data );
});

$klein->respond('GET', '/apis', function( $request, $response, $service, $app ){
	echo clients()->classname();
	echo clients()->tablename();
});

$klein->dispatch();

