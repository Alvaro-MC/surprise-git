<?php

// if (!isset($_GET['token'])) {
//     header('Location: ../index.php');
// }

require_once '../modelo/conexion.php';

$resp = null;

$decode = urldecode($_GET['token']);
$decod = base64_decode($decode);

$query = "select id_usuario from usuario where token = :token";
$prepared = $pdo->prepare($query);
$prepared->execute([
    'token' => $decod
]);
$resp = $prepared->fetch(PDO::FETCH_ASSOC);

// if (!isset($resp['id_usuario'])) {
//     header('Location: ../index.php');
// }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z1RNYPYEHC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-Z1RNYPYEHC');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/media.css">
    <link rel="stylesheet" type="text/css" href="../css/surprise.css">
    <link rel="stylesheet" type="text/css" href="../css/me_surprise.css">
    <link rel="stylesheet" type="text/css" href="../css/media-surprise.css">
    <link rel="stylesheet" type="text/css" href="../css/media-me-surprise.css">

    <script src="../js/index.js"></script>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="Icon" href="../css/img/iconos/favicon.svg" type=”image/x-icon” />
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
    ::placeholder{
        color: #824A97 !important;
    }
    </style>
</head>

<body>
    <!-- Cabecera -->
    <header class="header content">
        <div class="header-video">
            <video src="../css/video/video.mp4" autoplay loop></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">
            <!-- NAVBAR -->
            <div class="container-fluid container-nav">
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="index.php"><img src="../css/img/iconos/logo-blanco.svg" alt="Logo Surprise" class="img-personal-fluid mt-3 mb-3"></a>
                    </div>
                </div>
            </div>
            <div class="texto">
                <div class="container">
                    <div class="row" style="margin-top: 12%;">
                        <div class="col-12">
                            <form action="index.php" method="post" class="g-3 needs-validation" novalidate>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-10 col-md-6 col-lg-4 mb-3">
                                            <label for="pass" class="form-label">Contraseña</label>
                                            <input type="password" placeholder="Escriba aqui su contraseña"  class="form-control" id="pass" name="pass" required>
                                            <div class="invalid-feedback">
                                                Por favor ingresa tu contraseña
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10 col-md-6 col-lg-4 mb-3">
                                            <label for="repeatpass" class="form-label" value="">Repita su contraseña</label>
                                            <input type="password" placeholder="Escriba de nuevo su contraseña" class="form-control" id="repeatpass" name="repeatpass" required>
                                            <div class="invalid-feedback">
                                                Por favor ingresa tu contraseña
                                            </div>
                                            <input type="checkbox" onclick="ver_pass(true)" id="checkpass">
                                            <label for="checkpass" class="mt-3">Mostrar Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary btn-crear style-morado" type="submit" onclick="validateInput()">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>