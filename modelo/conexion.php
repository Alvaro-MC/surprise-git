<?php
$dbHost = '75.102.57.89';
$dbName = 'qhgawllm_bdsurprise';
$dbUser = 'qhgawllm';
$dbPass = 'FD,9#MF&.CtP';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    //$pdo = new PDO("mysql:$dbHost", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}

?>