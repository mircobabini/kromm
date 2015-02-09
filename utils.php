<?php
function controller( $ctr_name ){
	return require dirname(__FILE__)."/ctrs/{$ctr_name}.php";
}

function send_json_response( $success, $data = array() ){
	$response = array(
		'success' => $success,
		'data'    => $data,
	);

	return wp_send_json( $response );
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
