<?php
require 'vendor/autoload.php';

define( 'DIR_ROOT', dirname(__FILE__) );
define( 'DIR_CTRS', DIR_ROOT.'/ctrs' );
define( 'DIR_LIBS', DIR_ROOT.'/libs' );
define( 'DIR_OBJS', DIR_ROOT.'/objs' );

require 'utils.php';
require 'libs/entities.php';

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
$klein->respond('GET', '/home', function(){
	call_user_func_array( controller( 'home' ), func_get_args() );
});

$klein->respond('GET', '/apis', function( $request, $response, $service, $app ){
	echo clients()->classname();
	echo clients()->tablename();
	echo client(['o'=>1])->tablename();
});

$klein->dispatch();

