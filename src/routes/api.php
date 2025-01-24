<?php

use controllers\TransactionController;

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../controllers/TransactionController.php';
require_once __DIR__ . '/../utils/Paginator.php';

// Create a database connection
$dbConfig = require __DIR__ . '/../config/database.php';
$db = new PDO("pgsql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}", $dbConfig['user'], $dbConfig['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Instance of the controller
$transactionController = new TransactionController($db);

// Route management
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('?', $_SERVER['REQUEST_URI'])[0];

if ($requestUri === '/v1/transactions' && $requestMethod === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $response = $transactionController->create($data);
    echo json_encode($response);
    exit;
}

if ($requestUri === '/v1/transactions' && $requestMethod === 'GET') {
    $queryParams = $_GET;
    $response = $transactionController->getAll($queryParams);
    echo json_encode($response);
    exit;
}


// Response for routes not found
http_response_code(404);
echo json_encode(['status' => 404, 'message' => 'This route has not been found in the blossom api for transactions.']);
exit;