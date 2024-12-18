<?php
use projtecweb\myapi\Auth\Auth;
require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');

try {
    $auth = new Auth();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jsonOBJ = json_decode(file_get_contents('php://input'));
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON input');
        }
        $response = $auth->loginUser($jsonOBJ->username, $jsonOBJ->password);
        echo json_encode($response);
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>