<?php

require_once 'modelo/conexion.php';

$user = null;
$query = null;
$url  = null;

$resultAdd = false;
$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

if (!empty($_POST)) {

	$sql = "INSERT INTO usuario(nombre,apellido,correo,telefono,contrasena) VALUES (:nombre,:apellido,:correo,:telefono,:pass);";
	$query = $pdo->prepare($sql);
	$resultAdd = $query->execute([
		'nombre' => $_POST['nombre'],
		'apellido' => $_POST['apellido'],
		'correo' => $_POST['correo'],
		'telefono' => $_POST['telefono'],
		'pass' => $password
	]);

	if ($resultAdd) {
		session_start();


		$query = "SELECT * FROM usuario WHERE correo = :correo";
		$prepared = $pdo->prepare($query);
		$prepared->execute([
			'correo' => $_POST['correo']
		]);
		$user = $prepared->fetch(PDO::FETCH_ASSOC);

		if (isset($user['correo'])) {

			if ($user['correo'] == $_POST['correo'] && password_verify($_POST['pass'], $user['contrasena'])) {
				session_start();
				$_SESSION['id_usuario'] = $user['id_usuario'];
				$_SESSION['usuario'] = $user['correo'];
				$_SESSION['nombre'] = $user['nombre'];

				header("Location: {$_SERVER["HTTP_REFERER"]}");
			} else {
				echo "error";
			}
		} else {
			echo "No hay correo";
		}
	}
} else {
	echo "No se pudo registrar al usuario";
}
