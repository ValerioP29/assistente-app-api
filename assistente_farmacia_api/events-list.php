<?php
require_once('_api_bootstrap.php');
setHeadersAPI();
$decoded = protectFileWithJWT();

$user = get_my_data();
if( ! $user ){
	echo json_encode([
		'code'    => 401,
		'status'  => false,
		'error'   => 'Invalid or expired token',
		'message' => 'Accesso negato',
	]);
	exit();
}

//------------------------------------------------

$events = get_events((int) $user['starred_pharma']);

echo json_encode([
	'code'   => 200,
	'status' => true,
	'data'   => array_map( function($_event){
		return normalize_event_data($_event);
	}, $events ),
]);
