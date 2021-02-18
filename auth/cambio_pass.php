<?php

require_once '../modelo/conexion.php';

$query = null;
$resultAdd = false;

if (!empty($_POST)) {

    $password = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

    $query = "update usuario set contrasena=:contrasena, llave='', iv_token='', token='' where id_usuario=:id_usuario";
    $resultAdd = $pdo->prepare($query);
    $resultAdd->execute([
        'contrasena' => $password,
        'id_usuario' => $_POST['usuario']
    ]);

    if ($resultAdd) {
        echo true;
    }

} else {
    echo false;
}
