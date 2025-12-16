<?php
require_once('_api_bootstrap.php');
setHeadersAPI();
$decoded = protectFileWithJWT();

$user = get_my_data();
if( ! $user ){
	echo json_encode([
		'code'    => 401,
		'status'  => FALSE,
		'error'   => 'Invalid or expired token',
		'message' => 'Accesso negato',
	]);
	exit();
}

//------------------------------------------------

$now   = new DateTime();
$start = new DateTime('00:00');
$end   = new DateTime('00:15');
if ($now >= $start && $now <= $end) {
	echo json_encode([
		'code'    => 401,
		'status'  => FALSE,
		'error'   => 'Quiz Daily Maintenance Mode',
		'message' => 'Spiacenti, non è possibile inviare Quiz tra le 00:00 e le 00:15.',
	]);
	exit;
}

//------------------------------------------------

// $input = json_decode(file_get_contents("php://input"), TRUE);

$pharma = getMyPharma();
$quiz = QuizzesModel::getLastAvailable();
$points = $quiz? $quiz['points'] : 0;

$can_give_points = ! UserPointsModel::hasEntryForDate($user['id'], $pharma['id'], 'quiz_daily');
if( $can_give_points ){
	UserPointsModel::addPoints($user['id'], $pharma['id'], $points, 'quiz_daily');
}

echo json_encode([
	'code'    => 200,
	'status'  => TRUE,
	'message' => 'Quiz completato',
	'data'    => NULL,
]);
