<?php @session_start();

require_once 'modelo/conexion.php';

$url = null;
$fila_v = null;
$fila_i = null;
$indice_i = null;
$query = null;

$resultAdd = false;

if ($_POST['mensaje']) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    $video = $_POST['video'];

    $query = "SELECT count(*) FROM invitacion";
    $prepared = $pdo->prepare($query);
    $prepared->execute([]);
    $fila_i = $prepared->fetch(PDO::FETCH_ASSOC);
    $fila_i['count(*)'] += 1;

    $query = "SELECT count(*) FROM video";
    $prepared = $pdo->prepare($query);
    $prepared->execute([]);
    $fila_v = $prepared->fetch(PDO::FETCH_ASSOC);





    $key = 'grupomc';
    $string = $fila_i['count(*)'];

    $indice = md5($string,$key);



    $url = "me_surprise.php?i={$fila_i['count(*)']}";
    $_SESSION['url-oficial'] = $url;
?>
    <script>
        localStorage.setItem("link-oficial", <?php echo "" . $url . "" ?>)
    </script>
<?php

    $sql = "INSERT INTO invitacion(nombre,apellido,telefono,mensaje,url,id_usuario,id_video) VALUES (:nombre,:apellido,:telefono,:mensaje,:url,:id_usuario,:id_video);";

    $query = $pdo->prepare($sql);
    $resultAdd = $query->execute([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'telefono' => $telefono,
        'mensaje' => $mensaje,
        'url' => $url,
        'id_usuario' => $_SESSION['id_usuario'],
        'id_video' => $fila_v['count(*)']
    ]);
} else {
    echo "No se pudo registrar la invitacion";
}
