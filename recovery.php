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

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/surprise.css">
    <link rel="stylesheet" type="text/css" href="css/me_surprise.css">
    <link rel="stylesheet" type="text/css" href="css/media-surprise.css">
    <link rel="stylesheet" type="text/css" href="css/media-me-surprise.css">

    <?php require_once 'head.php'; ?>

    <style>
        ::placeholder {
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
                        <a href="index.php"><img src="css/img/iconos/logo-blanco.svg" alt="Logo Surprise" class="img-personal-fluid mt-3 mb-3"></a>
                    </div>
                </div>
            </div>
            <div class="texto">
                <div class="container">
                    <div class="row" style="margin-top: 12%;">
                        <div class="col-12">
                            <!-- <form action="index.php" method="post" class="g-3 needs-validation" novalidate> -->
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-10 col-md-6 col-lg-4 mb-3">
                                            <label for="email" class="form-label mb-3" style="color:#824A97;">Ingresa tu Correo electrónico</label>
                                            <input type="email" placeholder="Ingresa el correo a recuperar" class="form-control" id="emailrecovery" name="email" required>
                                            <div class="invalid-feedback">
                                                Por favor ingresa tu correo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center mt-3">
                                            <button class="btn btn-primary btn-crear style-morado" type="submit" onclick="recovery()">Recuperar Contraseña</button>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <p id="response" style="text-transform: none;"></p>
                                        </div>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
        function recovery() {
            correo = document.getElementById('emailrecovery').value
            $.ajax({
                url: "validate.php",
                method: "POST",
                data: {
                    correo: correo
                },
                success: function(data) {
                    document.getElementById('response').innerText = data;
                }
            });
        }
    </script>
</body>

</html>