<?php
function controller( $ctr_name ){
	return require dirname(__FILE__)."/ctrs/{$ctr_name}.php";
}
function database(){
	static $database;
	if( $database === null ){
		$database = new medoo([
			'database_type' => 'mysql',
			'database_name' => DB_NAME,
			'username' => DB_USER,
			'password' => DB_PASS,
			'server'   => DB_HOST,
		]);
	}

	return $database;
}

function send_json( $data = array() ){
	header('Content-Type: application/json');
	echo json_encode( $data );
	exit();
}
function send_json_response( $success, $data = array() ){
	$response = array(
		'success' => $success,
		'data'    => $data,
	);

	return send_json( $data );
}
function send_json_error( $data = array() ){
	if( is_string( $data ) ){
		$message = $data;
		
		$data = array();
		$data['message'] = $message;
	}

	return send_json_response( false, $data );
}
function send_json_success( $data = array() ){
	return send_json_response( true, $data );
}
