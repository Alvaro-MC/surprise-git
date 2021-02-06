<?php
$queryResult = $pdo->prepare("SELECT id_panel,stock_videos as stock from panel where id_panel=:panel");
$queryResult->execute([
    'panel' => $_POST['number']
]);
$pan = $queryResult->fetch(PDO::FETCH_ASSOC);
return $pan['stock_videos'];
?>