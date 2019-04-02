<?php
header ( 'Content-Type: application/json' );
$json = file_get_contents ( 'php://input' );
error_log(print_r($json, true));

$order = json_decode ( $json );

if ($order->{'order'}->{'id'} == null) {
	echo json_encode ( array (
			"errorCode" => 1 
	) );
	exit ();
}

$validState = array (
		"PENDING",
		"PARTIALLY_ASSIGNED",
		"ASSIGNED",
		"PARTIALLY_COMPLETED",
		"COMPLETED",
		"CANCELED" 
);

if (in_array ( $order->{'order'}->{'state'}, $validState )) {
	$response = array (
			'errorCode' => 0 
	);
} else {
	$response = array (
			"errorCode" => 2 
	);
}

echo json_encode ( $response );
