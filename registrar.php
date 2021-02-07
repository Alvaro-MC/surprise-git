<?php




require_once '/modelo/conexion.php';
$query = "SELECT * FROM panel";
		$prepared = $pdo->prepare($query);
		$prepared->execute([]);
		$user = $prepared->fetch(PDO::FETCH_ASSOC);

		echo $user['id_panel'];
		echo $user['id_panel'];
		echo $user['id_panel'];
		echo $user['id_panel'];
		echo $user['id_panel'];
		echo $user['id_panel'];
		echo $user['id_panel'];




$user = null;
$query = null;
$url  = null;

$resultAdd = false;
$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

if (!empty($_POST)) {

		$query = "SELECT * FROM usuario WHERE correo = :correo";
		$prepared = $pdo->prepare($query);
		$prepared->execute([
			'correo' => $_POST['correo']
		]);
		$user = $prepared->fetch(PDO::FETCH_ASSOC);

		if (!isset($user['correo'])) {

			$sql = "insert into usuario(nombre,apellido,correo,telefono,contrasena) values (:nombre,:apellido,:correo,:telefono,:pass);";
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
		
		
				$query = "select * from usuario where correo = :correo";
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
					
				}
			}

		}else{
			header('Location: https://www.surprise.com.pe/index.php?r=0');
		}



	
} else {
	echo "No se pudo registrar al usuario";
}
