<?php
$ajax_request = file_get_contents('php://input');
$data = json_decode($ajax_request, true);

if ($data['name'] === 'SAMURAI') {
    $data['name'] = 'TERAKOYA';
} else {
    $data['name'] = 'SAMURAI';
}

$response = [
    'message' => $data['name']
];

header('Content-Type: application/json');
echo json_encode($response);