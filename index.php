<?php
require 'vendor/autoload.php';

define( 'DIR_ROOT', dirname(__FILE__) );
define( 'DIR_FW', DIR_ROOT.'/framework' );

define( 'DIR_CTRS', DIR_FW.'/ctrs' );
define( 'DIR_LIBS', DIR_FW.'/libs' );
define( 'DIR_OBJS', DIR_FW.'/objs' );

require DIR_FW.'/utils.php';
require DIR_LIBS.'/entities.php';

define('DB_NAME', 'crm');
define('DB_USER', 'root');
define('DB_PASS', 'mysql');
define('DB_HOST', 'localhost');

// init controllers
// $entities = [ 'clients' ];
// foreach( $entities as $entity ){
// 	require_once DIR_OBJS.'/'.$entity.'/init.php';
// }

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
	echo e('clients')->classname();
	echo e('clients')->tablename();
});

$klein->dispatch();

