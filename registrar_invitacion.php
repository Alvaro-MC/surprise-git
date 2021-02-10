<?php @session_start();

require_once 'modelo/conexion.php';

$url = null;
$fila_v = null;
$fila_i = null;
$indice_i = null;
$query = null;

$resultAdd = false;
?>
<script>
    localStorage.setItem("res", false)
</script>
<?php

if ($_POST['mensaje']) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    $video = $_POST['video'];

    //Consulta para saber el id del video al que se le asignara a la invitacion
    $query = "  select max(id_video) as id_video from usuario u join video v on v.id_usuario = u.id_usuario where u.id_usuario = :id_usuario";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'id_usuario' => $_SESSION['id_usuario']
    ]);
    $video = $prepared->fetch(PDO::FETCH_ASSOC);

    $url = 'me_surprise.php';

    //Inserción de datos a la tabla invitacion
    $sql = "insert into invitacion(nombre,apellido,telefono,mensaje,url,id_usuario,id_video) values (:nombre,:apellido,:telefono,:mensaje,:url,:id_usuario,:id_video);";
    $query = $pdo->prepare($sql);
    $resultAdd = $query->execute([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'telefono' => $telefono,
        'mensaje' => $mensaje,
        'url' => $url,
        'id_usuario' => $_SESSION['id_usuario'],
        'id_video' => $video['id_video']
    ]);

    //Consulta para saber el id de la invitacion para asignarla a la url
    $query = "select max(id_invitacion) as id_invitacion from invitacion i join usuario u on i.id_usuario = u.id_usuario where i.id_usuario = :id_usuario and i.id_video = :id_video";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'id_usuario' => $_SESSION['id_usuario'],
        'id_video' => $video['id_video']
    ]);
    $invitacion = $prepared->fetch(PDO::FETCH_ASSOC);

    $cod = base64_encode($invitacion['id_invitacion']);
    $code = urlencode($cod);

    $url = "https://www.surprise.com.pe/me_surprise.php?i={$code}";

    $_SESSION['url-oficial'] = $url;
    $_SESSION['nro_invitacion'] = $invitacion['id_invitacion'];


    $query = "update invitacion i set url = :url where i.id_invitacion = :id_invitacion;";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'url' => $url,
        'id_invitacion' => $invitacion['id_invitacion']
    ]);

    if ($resultAdd) {
        echo $url;
    }
} else {
    echo "No se pudo registrar la invitacion";
}
