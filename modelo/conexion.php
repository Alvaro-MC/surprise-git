<?php
$dbHost = '/cloudsql/prueba-surprise:us-central1:bd-surprise-mc';
$dbName = 'bdsurprise';
$dbUser = 'alvaro-mc';
$dbPass = 'alvaro2021';

try {
    //$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo = new PDO("mysql:$dbHost", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}

?>