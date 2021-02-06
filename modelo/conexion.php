<?php
$dbHost = '34.122.176.83';
$dbName = 'bd-surprise-mc';
$dbUser = 'alvaro-mc';
$dbPass = 'Alvaro@2021';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}

?>