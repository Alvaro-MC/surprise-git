<?php @session_start();

if (!isset($_GET['i'])) {
    header('Location: index.php');
}

require_once 'modelo/conexion.php';

$resp = null;

$query = "SELECT * FROM invitacion I JOIN usuario U JOIN video V ON I.id_usuario = U.id_usuario AND I.id_video = V.id_video WHERE I.id_invitacion = :id_invitacion";
$prepared = $pdo->prepare($query);
$prepared->execute([
    'id_invitacion' => $_GET['i']
]);
$resp = $prepared->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/surprise.css">
    <link rel="stylesheet" type="text/css" href="css/me_surprise.css">
    <link rel="stylesheet" type="text/css" href="css/media-surprise.css">

    <script src="js/index.js"></script>

    <?php require_once 'head.php' ?>
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
                        <img src="css/img/iconos/logo-blanco.svg" alt="Logo Surprise" class="img-personal-fluid mt-3 mb-3">
                    </div>
                </div>
            </div>
            <div class="texto">
                <div class="container-fluid mt-4">
                    <div class="row text-center">
                        <div class="col-12">
                            <h1 class="nombre-rec"><strong><?php echo $resp['nombre_i'] ?>,</strong></h1>
                        </div>
                        <div class="col-12">
                            <p class="par-1"><strong><?php echo $resp['nombre'] ?> te ha dejado una sorpresa para este 14 de febrero:</strong></p>
                            <p class="mess-rec"><?php echo $resp['mensaje_i'] ?></p>
                        </div>
                        <div class="col-12 mt-5 mb-2">
                            <a class="btn btn-melon text-center mt-2 txt-btn">
                                <h3>Acercate el 14 de febrero a nuestro Pórtico ubicado en:</h3>
                            </a> 
                        </div>
                        <div class="col-12 mb-2 flex justify-content-center">
                            <img class="img-portico" src="css/img/iconos/ic_portico.svg" alt="Icono de un pórtico">
                            <a class="text-center mt-2 txt-btn mx-4">
                                <h4 class="txt-sub"><?php echo $resp['ubicacion'] ?></h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>