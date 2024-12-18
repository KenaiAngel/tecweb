<?php
use projtecweb\myapi\Auth\Auth;
require_once __DIR__ . '/vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['password']) && isset($data['ubicacion'])) {
    $auth = new Auth();
    $response = $auth->registerUser($data['username'], $data['password'], $data['ubicacion']);
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
}
?>
