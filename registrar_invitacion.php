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

    $query = "select count(*) as cantidad_invitacion from invitacion";
    $prepared = $pdo->prepare($query);
    $prepared->execute([]);
    $fila_i = $prepared->fetch(PDO::FETCH_ASSOC);
    $fila_i['cantidad_invitacion'] += 1;

    $query = "select count(*) as cantidad_video from video";
    $prepared = $pdo->prepare($query);
    $prepared->execute([]);
    $fila_v = $prepared->fetch(PDO::FETCH_ASSOC);

    $url = "me_surprise.php?i={$fila_i['cantidad_invitacion']}";
    $_SESSION['url-oficial'] = $url;
?>
    <script>
        localStorage.setItem("link-oficial", <?php echo "" . $url . "" ?>)
    </script>
    <?php

    $sql = "insert into invitacion(nombre,apellido,telefono,mensaje,url,id_usuario,id_video) values (:nombre,:apellido,:telefono,:mensaje,:url,:id_usuario,:id_video);";

    $query = $pdo->prepare($sql);
    $resultAdd = $query->execute([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'telefono' => $telefono,
        'mensaje' => $mensaje,
        'url' => $url,
        'id_usuario' => $_SESSION['id_usuario'],
        'id_video' => $fila_v['cantidad_video']
    ]);
    if ($resultAdd) {
    ?>
        <script>
            localStorage.setItem("res", true)
        </script>
<?php
    }
} else {
    echo "No se pudo registrar la invitacion";
}
