<?php
require_once('_api_bootstrap.php');
setHeadersAPI();
ob_start();
$decoded = protectFileWithJWT();

$user = get_my_data();
if( ! $user ){

        if( ob_get_length() ) ob_clean();
        echo json_encode([
                'code'    => 401,
                'status'  => FALSE,
		'error'   => 'Invalid or expired token',
		'message' => 'Accesso negato',
	]);
	exit();
}

//------------------------------------------------

$pharma = getMyPharma();
if( ! $pharma ){

        if( ob_get_length() ) ob_clean();
        echo json_encode([
                'code'    => 400,
                'status'  => FALSE,
		'error'   => 'Bad Request',
		'message' => 'Farmacia non valida.',
	]);
	exit();
}

$now   = new DateTime();
$start = new DateTime('00:00');
$end   = new DateTime('00:15');
if ($now >= $start && $now <= $end) {

        if( ob_get_length() ) ob_clean();
        echo json_encode([
                'code'    => 404,
                'status'  => FALSE,
		'error'   => 'Midnight Quiz Maintenance Mode',
		'message' => 'Il Quiz del giorno non è ancora pronto, torna tra 15min.',
	]);
	exit;
}

//------------------------------------------------

$quiz = QuizzesModel::getLastAvailable((int) $pharma['id']);

if( ! $quiz ){

        if( ob_get_length() ) ob_clean();
        echo json_encode([
                'code'    => 404,
                'status'  => FALSE,
		'error'   => 'Not Found',
		'message' => 'Spiacenti, oggi non è previsto nessun quiz.',
		'data'    => NULL,
	]);
	exit;
}

if( ob_get_length() ) ob_clean();

echo json_encode([
        'code'    => 200,
        'status'  => TRUE,
	'message' => NULL,
	'data'    => normalize_quiz_data($quiz),
]);
