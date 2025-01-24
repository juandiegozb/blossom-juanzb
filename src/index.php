<?php
$host = 'db';
$dbname = 'blossom-db';
$user = 'blossom';
$password = 'blossom';

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    echo "Successful connection to the database.<br>";

    $query = $pdo->query("SELECT NOW() as current_time");
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo "Current time: " . $result['current_time'];
} catch (PDOException $e) {
    echo "Connection error:" . $e->getMessage();
}
