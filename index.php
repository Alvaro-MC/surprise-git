<?php @session_start();
$user2 = null;
$user = null;
$query = null;
$url  = null;

if (!empty($_POST)) {

    require_once 'modelo/conexion.php';

    $query = "SELECT * FROM usuario WHERE correo = :correo";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'correo' => $_POST['correo']
    ]);
    $user = $prepared->fetch(PDO::FETCH_ASSOC);

    if (isset($user['correo'])) {

        if ($user['correo'] == $_POST['correo'] && password_verify($_POST['pass'], $user['contrasena'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['usuario'] = $user['correo'];
            $_SESSION['nombre'] = $user['nombre'];

            //echo "URL : " . $_SESSION['url'];

            if (isset($_SESSION['url']))
                $url = $_SESSION['url'];
            else
                $url = "index.php";

            header("Location: http://localhost/surprise/index.php");
        } else {
            $url = null;
        }
    } else {
        //No hay correo
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise</title>

    <?php require_once 'head.php' ?>

</head>

<body>

    <?php require_once 'popups.php' ?>

    <!-- Cabecera -> Video - NavBar - SliderNotas -->
    <header id="hero" class="header content">
        <div class="header-video">
            <video src="css/video/video.mp4" autoplay loop></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">

            <!-- NAVBAR -->
            <nav class="navbar navbar-dark">
                <div class="container-fluid">
                    <div>
                        <a href="#" class="toggle-nav js-nav hide" data-bs-toggle="collapse" data-bs-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars fa-2x"></i></a>

                        <div class="nav-wrap disp-true">
                            <nav class="menu mt-1">
                                <ul>
                                    <li><a href="#paneles">Mapa</a></li>
                                    <li><a href="#contacto">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Prueba de Envio post por AJAX -->
                    <input type="text" id="texto" value="1" style="display: none;">

                    <?php

                    //if (!isset($_SESSION)) {
                    if (!isset($_SESSION['id_usuario'])) {
                        //echo "No hay sesion";
                        echo <<< AAC
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ventanaModalSesion">Iniciar Sesión</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ventanaModalRegister">Registrarse</button>
                                </div>
                                AAC;
                    } else {
                        //echo 'Si hay sesion';
                        echo <<< LNH
                                <div>
                                    <p class="mb-0">Bienvenido
                                LNH;
                        echo "  " . $_SESSION['nombre'];
                        echo <<< AAA
                                </p>
                                <a href="cerrar.php">Cerrar Sesion</a>
                                </div>
                                AAA;
                    }
                    ?>

                </div>

                <div class="collapse navbar-collapse disp-none" id="navbarMobile">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#paneles-mobile">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="texto container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="container px-md-5">
                            <div class="row px-md-5">
                                <div class="col-12 px-md-4">
                                    <img class="img-fluid mx-md-5" src="css/img/iconos/logo.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>Sorprende en ese día especial</p>
                    </div>
                    <div class="col-12">
                        <a href="#"><i class="far fa-play-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-4">
                <div class="row disp-btn">
                    <div class="col-4"></div>
                    <div class="col-md-4 text-center disp-true">
                        <a href="#paneles"><i class="fas fa-angle-double-down"></i></a>
                    </div>
                    <div class="col-md-4 text-center text-center text-xl-right disp-true-hide">
                        <button type="button" class="btn btn-primary btn-sm btn-crear mr-md-4">
                            <a href="#paneles" class="flex caja-btn-crear">
                                <p><strong>Crear</strong></p>
                                <img class="img-fluid btn-carita-head" src="css/img/iconos/carita.svg">
                            </a>
                        </button>
                    </div>
                </div>
            </div>

            <!-- POSICION DEL CARD -->

            <div class="container mt-4 disp-none">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <button type="button" class="btn btn-primary btn-sm btn-crear mr-md-4">
                            <a href="#paneles-mobile" class="flex caja-btn-crear">
                                <p><strong>Crear</strong></p>
                                <img class="img-fluid btn-carita-head" src="css/img/iconos/carita.svg">
                            </a>
                        </button>
                    </div>
                    <div class="col-12 text-center">
                        <a href="#paneles-mobile"><i class="fas fa-angle-double-down"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <div class="container-fluid" id="carousel-fluid">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="col-12 carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner carousel-cards">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 align-self-center mt-4 text-left px-0">
                                        <h2 class="mayus ml-0 ml-md-4 text-center text-md-left" style="color:#fff;"><strong>Sorprende Free</strong></h2>
                                        <p class="carousel-card-par ml-0 ml-md-4">Este 14 de febrero inscribete en nuestra marcha blanca y sorprende gratis<br>Has que tus sentimientos repercutan en Trujillo</p>
                                    </div>
                                    <div class="col-md-4 mb-md-0 mb-4 text-right text-md-center img-margin-n">
                                        <img class="img-personal-fluid img-card-head" src="css/img/foto1.png" alt="First slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 align-self-center mt-4 text-left px-0">
                                        <h2 class="mayus ml-0 ml-md-4 text-center text-md-left" style="color:#fff;"><strong>En Trujillo suena tu feeling</strong></h2>
                                        <p class="carousel-card-par ml-0 ml-md-4">Hagamos juntos que este 14 de febrero, nuestro amor y amistad llene la ciudad de Trujillo de lindos mensajes</p>
                                    </div>
                                    <div class="col-md-4 mb-md-0 mb-4 text-right text-md-center img-margin-n">
                                        <img class="img-personal-fluid img-card-head" src="css/img/foto2.png" alt="Second slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 align-self-center mt-4 text-left px-0">
                                        <h2 class="mayus ml-0 ml-md-4 text-center text-md-left" style="color:#fff;"><strong>Personaliza tu plantilla</strong></h2>
                                        <p class="carousel-card-par ml-0 ml-md-4">Escribe tu saludo y has que sea único</p>
                                    </div>
                                    <div class="col-md-4 mb-md-0 mb-4 text-right text-md-center img-margin-n">
                                        <img class="img-personal-fluid img-card-head" src="css/img/foto3.png" alt="Third slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MATERIAL DE PANELES -->
    <section id="paneles" class="paneles-standard pt-3 pt-lg-5 pb-lg-2 disp-true">


        <!-- PopUp Panel -->
        <div class="container cont-p1">
            <div class="row">
                <div class="col-12 mt-3 mb-3 text-center">
                    <h5 class="mayus text-title-panel sub-t text-center title-select"><strong>Selecciona tu panel</strong></h5>
                </div>
            </div>
            <div class="row">
                <img src="css/img/mapa-pri.png" class="img-fluid mapa-principal" usemap="#mapa-panel">
            </div>
            <div class="row pt-4 pb-4"></div>
        </div>

        <map name="mapa-panel">
            <area shape="rect" coords="846,32,870,88" href="javascript:modal_mobile_panel(8,1)">
            <area shape="rect" coords="313,53,357,91" href="javascript:modal_mobile_panel(3,1)">
            <area shape="rect" coords="269,5,313,53" href="javascript:modal_mobile_panel(2,1)">
            <area shape="rect" coords="110,99,136,158" href="javascript:modal_mobile_panel(1,1)">
            <area shape="rect" coords="268,115,316,167" href="javascript:modal_mobile_panel(4,1)">
            <area shape="rect" coords="326,220,358,291" href="javascript:modal_mobile_panel(5,1)">
            <area shape="rect" coords="394,239,426,315" href="javascript:modal_mobile_panel(6,1)">
            <area shape="rect" coords="449,239,498,293" href="javascript:modal_mobile_panel(7,1)">
        </map>

    </section>
    <section class="disp-true">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row align-items-center pt-2 pb-2">
                        <div class="col-md-3 tex-center">
                            <div class="container pt-2 pb-2">
                                <div class="row px-3 caja-pasos">
                                    <div class="col-md-3 border-pasos">
                                        <h2><strong>1</strong></h2>
                                    </div>
                                    <div class="col-md-9 text-center">
                                        <p class="mt-3"><strong>Selecciona el panel</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 tex-center">
                            <div class="container pt-2 pb-2">
                                <div class="row px-3 caja-pasos">
                                    <div class="col-md-3 border-pasos">
                                        <h2><strong>2</strong></h2>
                                    </div>
                                    <div class="col-md-9 text-center">
                                        <p class="mt-3"><strong>Elige tu <br> plantilla</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 tex-center">
                            <div class="container pt-2 pb-2">
                                <div class="row px-3 caja-pasos">
                                    <dib class="col-md-3 border-pasos">
                                        <h2><strong>3</strong></h2>
                                    </dib>
                                    <div class="col-md-9 text-center">
                                        <p class="mt-3"><strong>Completa el formulario</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 tex-center">
                            <div class="container pt-2 pb-2">
                                <div class="row px-3 caja-pasos">
                                    <div class="col-md-3 border-pasos">
                                        <h2><strong>4</strong></h2>
                                    </div>
                                    <div class="col-md-9 text-center">
                                        <p class="mt-3"><strong>Acércate al panel y sube una historia</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CARDS MOBILE -->
    <section id="paneles-mobile" class="disp-none">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mayus text-center mt-4 mb-4 title-mobile-card pt-2 pb-2"><strong>Elige tu panel</strong></h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(1,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel Parque Eterno</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(2,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel La Esperanza</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(3,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel La Esperanza</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(4,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel Mall Aventura</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(5,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel El Golf</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(6,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel Av. Fátima</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(7,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel Real Plaza</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(8,2)">
                                    <img class="img-fluid" src="css/img/ubicacion-1.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Panel El Porvenir</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php require_once 'footer.php'; ?>

    <script>
        function modalPanel() {
            $('#ventanaModalPanel1').modal('show');
        }
        $('.js-nav').click(function() {
            $(this).parent().find('.menu').toggleClass('active');
        });
    </script>

</body>

</html>