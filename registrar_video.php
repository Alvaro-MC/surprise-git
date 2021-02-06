<?php @session_start();

require_once 'modelo/conexion.php';

$fila = null;
$query = null;
$panel_q = null;
$fecha = "2021-02-14";

$resultAdd = false;

if ($_POST['mensaje']) {

    $mensaje = $_POST['mensaje'];
    $panel = $_POST['panel'];
    $video = $_POST['video'];
    $_SESSION['panel'] = $panel;
    $_SESSION['video'] = $video;

    $mensaje = substr($mensaje,0,20);

    $query = "SELECT count(*) FROM video";
    $prepared = $pdo->prepare($query);
    $prepared->execute([]);
    $fila = $prepared->fetch(PDO::FETCH_ASSOC);
    $fila['count(*)'] += 1;

    $query = "select * from panel where id_panel=:id_panel";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'id_panel' => $panel
    ]);
    $panel_q = $prepared->fetch(PDO::FETCH_ASSOC);

    $sql = "insert into video(ubicacion,fecha,mensaje,nro_video,id_usuario,id_panel) values (:ubicacion,:fecha,:mensaje,:video,:id_usuario,:id_panel);";

    $query = $pdo->prepare($sql);
    $resultAdd = $query->execute([
        'ubicacion' => $panel_q['ubicacion'],
        'fecha' => $fecha,
        'mensaje' => $mensaje,
        'video' => $video,
        'id_usuario' => $_SESSION['id_usuario'],
        'id_panel' => $panel_q['id_panel']
    ]);

    if ($resultAdd) {
        $query = "update panel set stock_videos=stock_videos+1 where id_panel = :id_panel";
        $prepared = $pdo->prepare($query);
        $prepared->execute([
            'id_panel' => $panel
        ]);
    }
} else {
    echo "No se pudo registrar el video";
    return false;
}
