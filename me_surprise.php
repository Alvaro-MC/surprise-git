<?php

if (!isset($_GET['i'])) {
    header('Location: index.php');
}

require_once 'modelo/conexion.php';

$resp = null;

$decode = urldecode($_GET['i']);
$decod = base64_decode($decode);

$query = "select u.nombre as nombre_user, i.nombre as nombre_rec, i.id_invitacion as invitacion, i.mensaje as mensaje_inv, v.ubicacion as ubicacion_video, v.id_panel as panel from invitacion i join usuario u on i.id_usuario = u.id_usuario join video v on i.id_video = v.id_video where i.id_invitacion = :id_invitacion";
$prepared = $pdo->prepare($query);
$prepared->execute([
    'id_invitacion' => $decod
]);
$resp = $prepared->fetch(PDO::FETCH_ASSOC);

if (!isset($resp['invitacion'])) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/surprise.css">
    <link rel="stylesheet" type="text/css" href="css/me_surprise.css">
    <link rel="stylesheet" type="text/css" href="css/media-surprise.css">
    <link rel="stylesheet" type="text/css" href="css/media-me-surprise.css">

    <script src="js/index.js"></script>

    <?php require_once 'head.php'; ?>
</head>

<body>
    <!-- Cabecera -->
    <header class="header content">
        <div class="header-video">
            <video src="css/video/video.mp4" autoplay loop></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">
            <!-- NAVBAR -->
            <div class="container-fluid container-nav">
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="index.php"><img src="css/img/iconos/logo-blanco.svg" alt="Logo Surprise" class="img-personal-fluid mt-3 mb-3"></a>
                    </div>
                </div>
            </div>
            <div class="texto">
                <div class="container-fluid mt-4">
                    <div class="row text-center justify-content-center">
                        <div class="col-12">
                            <h1 class="nombre-rec"><strong><?php echo $resp['nombre_rec']; ?>,</strong></h1>
                        </div>
                        <div class="col-12">
                            <p class="par-1 font-ine"><strong><?php echo $resp['nombre_user']; ?> te ha dejado una sorpresa para este 14 de febrero:</strong></p>
                            <p class="mess-rec font-ine"><?php echo $resp['mensaje_inv']; ?></p>
                        </div>
                        <div class="col-12 mt-5 mb-2">
                            <a class="text-center mt-2">
                                <h3 class="font-ine txt-acer">Acercate el 14 de febrero a nuestro Pórtico ubicado en:</h3>
                            </a>
                        </div>
                        <div class="col-12 mb-2 flex justify-content-evenly justify-content-md-center btn-melon align-items-center">
                            <img class="img-portico" <?php if ($resp['panel'] == 5 || $resp['panel'] == 6) { ?>
                                src="css/img/iconos/ic_paradero.svg"
                                    <?php } else { ?>
                                        src="css/img/iconos/ic_portico.svg" style="width: 40px !important;" <?php } ?> alt="Icono de un pórtico">             
                            <a class="text-center mt-2 txt-btn mx-1 txt-btn">
                                <h4 class="txt-sub font-ine"><?php echo $resp['ubicacion_video']; ?></h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container px-0">
                    <div class="row justify-content-center mt-4 mx-0">
                        <div class="col-12 flex justify-content-center col-img px-0 mx-0">
                            <div class="cont-par">
                                <p class="par-img">No olvides compartir tus historias y etiquetarnos en nuestras redes sociales</p>
                            </div>
                            <div class="circle-img">
                                <img class="img-mano" src="css/img/iconos/mano.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>