<?php

if (!isset($_GET['em']) && !isset($_GET['token'])) {
    header('Location: ../index.php');
}

require_once '../modelo/conexion.php';

$resp = null;

/* Variables para descifrado de correo */
$method = 'aes128';
$pass = "correo9para8cifrar7envio6por5la4url3";
$iv = "e71865c3f21caf4a";


$decodeEmail = urldecode($_GET['em']);
$decodEmail = base64_decode($decodeEmail);
$EmailDescifrado = openssl_decrypt($decodEmail, $method, $pass, false, $iv);

$query = "select * from usuario where correo = :correo";
$prepared = $pdo->prepare($query);
$prepared->execute([
    'correo' => $EmailDescifrado
]);
$user = $prepared->fetch(PDO::FETCH_ASSOC);

if (isset($user['id_usuario'])) {

    /* Variables para descifrar el token */
    $method = 'aes128';
    $llaveDecrypt = $user['llave'];
    $iv = $user['iv_token'];

    $decodeToken = urldecode($_GET['token']);
    $decodToken = base64_decode($decodeToken);
    $TokenDescifrado = openssl_decrypt($decodToken, $method, $llaveDecrypt, false, $iv);

    if (!password_verify($TokenDescifrado, $user['token'])) {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}

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
        ::placeholder {
            color: #824A97 !important;
        }

        @keyframes loading {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
                            <div class="container" style="color:#824A97;">
                                <div class="row justify-content-center">
                                    <div class="col-10 col-md-6 col-lg-4 mb-3">
                                        <label for="pass_new" class="form-label">Contraseña</label>
                                        <input type="password" placeholder="Escriba aqui su contraseña" class="form-control" id="pass_new" name="pass" required>
                                        <div class="invalid-feedback">
                                            Por favor ingresa tu contraseña
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-10 col-md-6 col-lg-4 mb-3">
                                        <label for="pass_repeat_new" class="form-label" value="">Repita su contraseña</label>
                                        <input type="password" placeholder="Escriba de nuevo su contraseña" class="form-control" id="pass_repeat_new" name="repeatpass" required>
                                        <div class="invalid-feedback">
                                            Por favor ingresa tu contraseña
                                        </div>
                                        <input type="checkbox" onclick="v_pass()" id="checkpass">
                                        <label for="checkpass" class="mt-3">Mostrar Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary btn-crear style-morado" type="submit" onclick="validatePass()">Confirmar</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <div class="a" id="alertCh"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
        function v_pass() {
            x = document.getElementById("pass_new")
            y = document.getElementById("pass_repeat_new")

            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }

        function validatePass() {
            pass_new = document.getElementById('pass_new')
            pass_repeat = document.getElementById('pass_repeat_new')

            document.getElementById('alertCh').classList.remove('alert')
            document.getElementById('alertCh').classList.remove('alert-warning')
            document.getElementById('alertCh').classList.remove('alert-danger')
            document.getElementById('alertCh').classList.remove('alert-success')
            document.getElementById('alertCh').innerHTML = '<div id="loading" class="mx-auto mt-2" style="width: 40px;height: 40px;border: 4px solid green;border-right: 4px solid transparent;border-radius: 20px;animation-name: loading;animation-duration: 1s;animation-iteration-count: infinite;animation-timing-function: linear;"></div>'

            if (pass_new.value.length > 0 && pass_repeat.value.length > 0) {
                if (pass_new.value == pass_repeat.value) {
                    password = pass_new.value
                    $.ajax({
                        url: "cambio_pass.php",
                        method: "POST",
                        data: {
                            usuario: <?php echo $user['id_usuario']; ?>,
                            newpass: password
                        },
                        success: function(data) {
                            console.log(data)
                            if (data) {
                                document.getElementById('alertCh').classList.remove('alert-warning')
                                document.getElementById('alertCh').classList.remove('alert-danger')
                                document.getElementById('alertCh').classList.add('alert')
                                document.getElementById('alertCh').classList.add('alert-success')
                                document.getElementById('alertCh').innerText = 'La contraseña ha sido cambiada'
                                setTimeout(function() {
                                    location.href = "../index.php"
                                }, 3000);
                            } else {
                                document.getElementById('alertCh').classList.remove('alert-warning')
                                document.getElementById('alertCh').classList.remove('alert-success')
                                document.getElementById('alertCh').classList.add('alert')
                                document.getElementById('alertCh').classList.add('alert-danger')
                                document.getElementById('alertCh').innerText = 'La contraseña no ha sido cambiada, por farvor intenta de nuevo o comunicate con el área de soporte'
                                setTimeout(function() {
                                    location.href = "../index.php"
                                }, 4000);
                            }

                        }
                    });
                } else {
                    document.getElementById('alertCh').classList.remove('alert-warning')
                    document.getElementById('alertCh').classList.remove('alert-success')
                    document.getElementById('alertCh').classList.add('alert')
                    document.getElementById('alertCh').classList.add('alert-danger')
                    document.getElementById('alertCh').innerText = 'Las contraseñas no son iguales'
                }
            } else {
                document.getElementById('alertCh').classList.remove('alert-danger')
                document.getElementById('alertCh').classList.remove('alert-success')
                document.getElementById('alertCh').classList.add('alert')
                document.getElementById('alertCh').classList.add('alert-warning')
                document.getElementById('alertCh').innerText = 'Por favor ingresa una contraseña válida'
            }
        }
    </script>
</body>

</html>