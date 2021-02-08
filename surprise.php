<?php @session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /index.php');
}

require_once 'modelo/conexion.php';

?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" type="text/css" href="css/media-surprise.css">

    <script src="/js/index.js"></script>

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
                    <div class="row text-center">
                        <div class="col-12">
                            <h1><strong>GRACIAS</strong></h1>
                        </div>
                        <div class="col-12">
                            <p class="mayus">Por confiarnos tu felicidad y la de tu persona especial</p>
                            <p class="mayus">Nos alegra que ya sean parte de la familia de <strong>surprise</strong></p>
                        </div>
                        <div class="col-12 mt-5 mb-2">
                            <h2><strong>COMPARTE</strong></h2>
                            <p>¡Y llena de alegria!</p>
                            <a class="btn btn-melon text-center mt-2" href="#form-float">
                                <h3>Mensaje Sorpresa</h3>
                            </a>
                        </div>
                        <div class="col-12 mb-4">
                            <div><a href="#form-float"><i class="fas fa-angle-double-down"></i></a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="container disp-float mt-5 mb-5" id="form-float">
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mb-3">
                <label for="nombre_r" class="form-label">Nombre del receptor</label>
                <input type="text" class="form-control" id="nombre_r" required>
                <div class="invalid-feedback">
                    Por favor ingresa el nombre del receptor
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="apellido_r" class="form-label">Apellido del receptor</label>
                <input type="text" class="form-control" id="apellido_r" required>
                <div class="invalid-feedback">
                    Por favor ingresa el apellido del receptor
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="telefono_r" class="form-label">Telefono del receptor</label>
                <input type="number" class="form-control" id="telefono_r" required>
                <div class="invalid-feedback">
                    Por favor ingresa el telefono del receptor
                </div>
            </div>
            <div class=" col-12 mb-3">
                <label for="mensaje_r" class="form-label">Escribe un mensaje</label>
                <textarea class="form-control txa-mensaje" id="mensaje_r" placeholder="Escribe aqui tu mensaje" required></textarea>
                <div class="invalid-feedback">
                    Por favor escribe un mensaje</div>
            </div>
            <div class=" col-12 mb-3">
                <label class="form-label">Ubicacion del panel</label>
                <div class="btn-special">
                    <script>
                        document.write(localStorage.getItem("direccion"))
                    </script>
                </div>
            </div>
            <div class=" col-12 col-md-4 mb-3">
                <label class="form-label">Fecha del anuncio</label>
                <div class="text-center btn-special">14 de Febrero</div>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-primary btn-crear" id="btn-compartir-inv" type="submit" onclick="compartir()">Compartir</button>
            </div>
        </form>
    </div>

    <!-- Button link modal -->
    <button id="success" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="display:none;">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-sesion">
                <div class="modal-header modal-sesion-header">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h5 id="tituloVentana" class="text-center">Gracias por ser parte de <strong>SURPRISE</strong></h5>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center pt-3">
                                <input class="input-link" id="url-copy" value=<?php echo $_SESSION['url-oficial'] ?>>
                            </div>
                            <div class="col-12 pt-5">
                                <ol class="social-link justify-content-center">
                                    <li><a href="#" onclick="copy('url-copy')" class="item-link cp"><i class="fas fa-copy"></i></a></li>
                                    <li><a class="item-link wp" href="https://web.whatsapp.com/send?text=<?php echo $_SESSION['url-oficial'] ?>" data-action="share/whatsapp/share" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-crear" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>

    <script>
        if (localStorage.getItem('res') == 'true') {
            document.getElementById('success').click()
        }
        $('.js-nav').click(function() {
            $(this).parent().find('.menu').toggleClass('active');
        });

        function copy(elemento) {
            a = document.getElementById(elemento)
            a.select();
            document.execCommand("copy");
        }

        function compartir() {
            nombre_r = document.getElementById('nombre_r')
            apellido_r = document.getElementById('apellido_r')
            telefono_r = document.getElementById('telefono_r')
            mensaje_r = document.getElementById('mensaje_r')

            if (nombre_r.value.length >= 40 || apellido_r.value.length >= 40 || telefono_r.value.length > 11) {
                if (nombre_r.value.length >= 40) {
                    nombre_r.value = ""
                }
                if (apellido_r.value.length >= 40) {
                    apellido_r.value = ""
                }
                if (telefono_r.value.length > 11) {
                    telefono_r.value = ""
                }
            }


            if (nombre_r.value != '' && apellido_r.value != '' && telefono_r.value != '') {
                $.ajax({
                    url: "registrar_invitacion.php",
                    method: "POST",
                    data: {
                        nombre: nombre_r.value,
                        apellido: apellido_r.value,
                        telefono: telefono_r.value,
                        mensaje: mensaje_r.value,
                        video: localStorage.getItem("boton2")
                    },
                    success: function(data) {
                        //Registrado
                        localStorage.setItem("res", true)
                        nombre_r.value = ""
                        apellido_r.value = ""
                        telefono_r.value = ""
                        mensaje_r.value = ""
                        location.reload()
                    }
                });
            }

            validateInput()
        }
    </script>

</body>

</html>