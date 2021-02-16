<?php @session_start();

$user = null;
$query = null;
$url  = null;

if (isset($_GET['r'])) {
    if ($_GET['r'] == 0) {
?>
        <script>
            alert("Parece que ya hay una cuenta registrada con ese correo")
        </script>
<?php
    }
}

if (!empty($_POST)) {

    require_once 'modelo/conexion.php';

    $query = "SELECT * FROM usuario WHERE correo = :correo";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'correo' => $_POST['correo']
    ]);
    $user = $prepared->fetch(PDO::FETCH_ASSOC);

    if (isset($user['correo']) && $user['estado'] == 'activo') {

        if ($user['correo'] == $_POST['correo'] && password_verify($_POST['pass'], $user['contrasena'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['usuario'] = $user['correo'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['correo'] = $user['correo'];

            //echo "URL : " . $_SESSION['url'];

            if (isset($_SESSION['url']))
                $url = $_SESSION['url'];
            else
                $url = "index.php";

            header("Location: index.php");
        } else {
            $url = null;
        }
    } else {
        //No hay correo
    }
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

    <?php require_once 'head.php'; ?>

    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 3500
            });
        });
    </script>

</head>

<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v9.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution="setup_tool" page_id="106095851325583" theme_color="#c75c59" logged_in_greeting="¡Hola! como podemos ayudarte?" logged_out_greeting="¡Hola! como podemos ayudarte?">
    </div>

    <?php require_once 'popups.php'; ?>

    <!-- Cabecera -> Video - NavBar - SliderNotas -->
    <header id="hero" class="header content">
        <div class="header-video back-video">
            <!--<img src="css/img/cover-pri.png" style="width:100%; height:100%; margin-top:30px"></img>-->
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
                                    <li class="first-border"><a class="first-item" href="#paneles">Mapa</a></li>
                                    <li><a class="mx-1" href="#contacto">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Prueba de Envio post por AJAX -->
                    <input type="text" id="texto" value="1" style="display: none;">

                    <?php

                    if (!isset($_SESSION['id_usuario'])) {
                    ?>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm style-blanco" data-bs-toggle="modal" data-bs-target="#ventanaModalSesion">Iniciar Sesión</button>
                            <button type="button" class="btn btn-primary btn-sm mx-0 style-blanco" data-bs-toggle="modal" data-bs-target="#ventanaModalRegister">Registrarse</button>
                            <button type="button" class="btn btn-primary btn-sm style-blanco" id="gracias" data-bs-toggle="modal" data-bs-target="#ventanaGracias" style="display:none;">Gracias</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div>
                            <p class="mb-0">Bienvenido <?php echo $_SESSION['nombre']; ?>

                            </p>
                            <a href="cerrar.php">Cerrar Sesion</a>
                        </div>
                    <?php
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
            <div class="container-fluid text-align-right">
                <div class="row">
                    <div class="col-12">
                        <button class="btn">
                            <a class="flex caja-btn-crear crear-panel style-melon mt-3" href="#paneles">
                                <p><strong>Crear</strong></p><img class="img-fluid btn-carita-head" src="css/img/iconos/carita.svg">
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <a href="https://api.whatsapp.com/send?phone=+51 915157954" target="_blank" class="btn-whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></li>
        </ol>
        <div class="carousel-inner carousel-cards">
            <div class="carousel-item active carousel-item-head">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 align-self-center mt-4 text-left px-0">
                            <h2 class="mayus ml-0 ml-md-4 text-md-left" style="color:#fff;"><strong>Sorprende Free</strong></h2>
                            <p class="carousel-card-par ml-0 ml-md-4">Este verano sorprende a tu viejit@, a tu causa o a tu flac@ con tu spot personalizado. Inscribete en nuestra marcha blanca y sorprende gratis</p>
                        </div>
                        <div class="col-md-4 mb-md-0 mb-4 text-align-right text-md-center img-margin-n">
                            <img class="img-personal-fluid img-card-head" src="css/img/foto1.png" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-item-head">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 align-self-center mt-4 text-left px-0">
                            <h2 class="mayus ml-0 ml-md-4 text-md-left" style="color:#fff;"><strong>Mensajes positivos</strong></h2>
                            <p class="carousel-card-par ml-0 ml-md-4">Este verano llena la ciudad de mensajes positivos y de paz para tu familia y amigos. Sorprende con <strong>Surprise</strong></p>
                        </div>
                        <div class="col-md-4 mb-md-0 mb-4 text-align-right text-md-center img-margin-n">
                            <img class="img-personal-fluid img-card-head" src="css/img/foto2.png" alt="Second slide">
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-item-head">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 align-self-center mt-4 text-left px-0">
                            <h2 class="mayus ml-0 ml-md-4 text-md-left" style="color:#fff;"><strong>Personaliza tu plantilla</strong></h2>
                            <p class="carousel-card-par ml-0 ml-md-4">Escribe tu saludo y haz que sea único</p>
                        </div>
                        <div class="col-md-4 mb-md-0 mb-4 text-align-right text-md-center img-margin-n">
                            <img class="img-personal-fluid img-card-head" src="css/img/foto3.png" alt="Third slide">
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
                                        <p class="mt-1"><strong>Acércate al panel y sube una historia</strong></p>
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
                                    <img class="img-fluid" src="css/img/portico-huanchaco.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórtico Huanchaco</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(2,2)">
                                    <img class="img-fluid" src="css/img/portico-laesperanza01.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórtico Esperanza 01</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(3,2)">
                                    <img class="img-fluid" src="css/img/portico-laesperanza02.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórtico Esperanza 02</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(4,2)">
                                    <img class="img-fluid" src="css/img/portico-mallplaza.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórtico Mall Aventura</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(5,2)">
                                    <img class="img-fluid" src="css/img/paradero-elgolf.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Paradero El Golf</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(6,2)">
                                    <img class="img-fluid" src="css/img/paradero-larco.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Paradero Av. Larco</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(7,2)">
                                    <img class="img-fluid" src="css/img/portico-realplaza.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórtico Real Plaza</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="container">
                            <div class="row px-3">
                                <a class="col-12 text-center p-0 caja-img-mobile-card" href="javascript:modal_mobile_panel(8,2)">
                                    <img class="img-fluid" src="css/img/portico-elporvenir.jpg" alt="First slide">
                                    <h4 class="mayus ml-0 ml-md-4 text-center mt-3"><strong>Pórticos El Porvenir</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container px-5 mt-3 mb-3">
        <div class="row anuncio">
            <div class="col-12 p-4">
                <p>"Recuerde que su anuncio debe hacerlo <strong>antes de las 5 P.M.</strong> si quiere que aparezca <strong>el día siguiente.</strong> De no ser asi, se estará subiendo en un plazo de 48 horas."</p>
            </div>
        </div>
    </section>

    <!-- PopUp Surprise -->
    <div class="modal fade" id="ventanaSurprise" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-dialog-centered modal-lg justify-content-center" role="document">
            <div class="modal-content mc-panel p-0" style="border:0; background-color:transparent">
                <div class="modal-body p-0">
                    <div class="container-fluid cont-modal-panel p-0">
                        <div class="row row-up">
                            <div class="col-12">
                                <div class="sombra-panel" style="
                                width: 100%;
                                background-color: transparent;
                                box-shadow: none;">
                                    <video id="video-pop-surprise" class="video-ini" style="height:80vh;" src="css/video/video-pop-web.mp4" autoplay loop controls></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="prueba-btn-1" class="btn-surprise" data-bs-toggle="modal" data-bs-target="#ventanaModalPanel1" style="display:none;"></button>
    <button type="button" id="prueba-btn-2" class="btn-surprise" data-bs-toggle="modal" data-bs-target="#modalMobilePanel" style="display:none;"></button>

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