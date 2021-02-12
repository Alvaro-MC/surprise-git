<!-- PopUp Inicio de Sesion -->
<div class="modal fade" id="ventanaModalSesion" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sesion">
            <div class="modal-header modal-sesion-header">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h5 id="tituloVentana">Iniciar Sesión</h5>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="modal-body modal-sesion-body">
                <form action="index.php" method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-12 mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                        <div class="invalid-feedback">
                            Por favor ingresa tu correo electrónico
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="pass_sesion" class="form-label" value="">Contraseña</label>
                        <input type="password" class="form-control" id="pass_sesion" name="pass" required>
                        <div class="invalid-feedback">
                            Por favor ingresa una contraseña
                        </div>
                        <input type="checkbox" onclick="ver_pass(true)" id="checkpass">
                        <label for="checkpass">Mostrar Contraseña</label>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-crear style-morado" type="submit" onclick="validateInput()">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PopUp de Registro -->
<div class="modal fade" id="ventanaModalRegister" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content modal-sesion">
            <div class="modal-header modal-sesion-header">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h5 id="tituloVentana">Registrate</h5>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="modal-body modal-sesion-body">
                <form action="registrar.php" method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-12 mb-3">
                        <label for="name_register" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name_register" name="nombre" required>
                        <div class="invalid-feedback">
                            Por favor asegurate de ingresar un nombre válido
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="last_name_register" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="last_name_register" name="apellido" required>
                        <div class="invalid-feedback">
                            Por favor asegurate de ingresar un apellido válido
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email_register" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email_register" name="correo" required>
                        <div class="invalid-feedback">
                            Por favor asegurate de ingresar un correo válido
                        </div>
                    </div>
                    <div class=" col-12 mb-3">
                        <label for="phone_register" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" id="phone_register" name="telefono" maxlength="11" required>
                        <div class="invalid-feedback">
                            Por favor asegurate que tu telefono es correcto
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass_register" name="pass" required>
                        <input type="checkbox" onclick="ver_pass(false)" id="checkpass2">
                        <label for="checkpass2">Mostrar Contraseña</label>
                        <div class="invalid-feedback">
                            Por favor ingresa una cotraseña válida
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Aceptar Términos y Condiciones
                            </label>
                            <div class="invalid-feedback mb-2">
                                Debes estar de acuerdo antes de enviar
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-crear style-morado" type="submit" onclick="validate()">Registrarme</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PopUp de Panel 1 -->
<div class="modal fade" id="ventanaModalPanel1" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content mc-panel">
            <div class="modal-body">
                <div class="container-fluid cont-modal-panel">
                    <div class="row row-up">
                        <div class="col-md-8">
                            <div class="sombra-panel">
                                <img src="css/img/portico-mallplaza.jpg" class="img-fluid" id="img-left-popup-variable-web">
                            </div>
                        </div>
                        <div class="col-md-4 ms-auto sombra-panel pt-3">
                            <img id="img-right-popup-variable-web" src="css/img/mapa-1.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 ms-auto">
                            <div class="cont-modal-img-panel sombra-panel">
                                <img src="css/img/panel-1.png" class="img-fluid" id="img-down-popup-variable-web">
                            </div>
                        </div>
                        <div class="col-md-9 ms-auto">
                            <div class="div-list-panel sombra-panel">
                                <ol class="list-panel px-4 pt-4 pb-3">
                                    <form action="home.php" method="post">
                                        <li class="item-list-panel" style="display:none;">
                                            <input class="item-pop-up mayus ml-0 ml-md-4 text-center" id="text-title-popup-variable-web" value="" name="titulo" disabled="">
                                        </li>
                                        <li class="item-list-panel">
                                            <img src="css/img/iconos/ICONOS-01.svg">
                                            <input class="item-pop-up" id="text-first-popup-variable-web" name="horario" value="" disabled="">
                                        </li>
                                        <li class="item-list-panel">
                                            <img src="css/img/iconos/ICONOS-02.svg">
                                            <input class="item-pop-up" id="text-second-popup-variable-web" name="direccion" value="" disabled="">
                                        </li>
                                        <li class="item-list-panel">
                                            <img src="css/img/iconos/ICONOS-03.svg">
                                            <input class="item-pop-up" id="text-third-popup-variable-web" name="tamano" value="" disabled="">
                                        </li>
                                    </form>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-4"></div>
                        <div class="col-4 text-center" id="btn-stock-panel">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PopPup Mobile Panel -->
<div class="modal fade" id="modalMobilePanel" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sesion">
            <div class="modal-header modal-sesion-header">
                <div class="col-12">
                    <h5 id="tituloVentana" class="mayus text-center">Elige tu Panel</h5>
                </div>
            </div>

            <div class="modal-body modal-sesion-body">
                <div class="container">
                    <div class="row px-3">
                        <div class="col-12 text-center p-2 caja-img-mobile-card" style="background-color: #EC6460; transform: scale(1);">
                            <img class="img-fluid" id="img-left-popup-variable-mobile" src="css/img/portico-huanchaco.jpg" alt="First slide">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <ol class="list-panel px-4 pt-4 pb-3 text-left">
                                <form action="home.php" method="post">
                                    <li class="item-list-panel item-list-panel-mobile">
                                        <input class="item-pop-up pop-mob mayus ml-0 ml-md-4 text-center" id="text-title-popup-variable-mobile" value="" name="titulo" disabled="">
                                    </li>
                                    <li class="item-list-panel item-list-panel-mobile">
                                        <i class="far fa-clock mr-3"></i>
                                        <input class="item-pop-up pop-mob" id="text-first-popup-variable-mobile" value="" name="horario" disabled="">
                                    </li>
                                    <li class="item-list-panel item-list-panel-mobile">
                                        <i class="fas fa-map-marked-alt mr-3"></i>
                                        <input class="item-pop-up pop-mob" id="text-second-popup-variable-mobile" value="" name="direccion" disabled="">
                                    </li>
                                    <li class="item-list-panel item-list-panel-mobile">
                                        <i class="fas fa-ruler-combined mr-3"></i>
                                        <input class="item-pop-up pop-mob" id="text-third-popup-variable-mobile" value="" name="tamano" disabled="">
                                    </li>
                                </form>
                            </ol>
                        </div>
                        <div class="col-12 text-center">
                            <div class="container-fluid">
                                <div class="row mb-3">
                                    <div class="col-3"></div>
                                    <div class="col-6 text-center" id="btn-stock-panel-mobile">
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PopUp Gracias -->
<div class="modal fade" id="ventanaGracias" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-sesion">
            <div class="modal-header modal-sesion-header justify-content-center">
                <div class="col-12 col-md-6 col-lg-8 align-self-center text-center mt-3 mb-3 mt-md-0 mb-md-0">
                    <a href="index.php"><img src="css/img/iconos/logo-blanco.svg" class="img-foo img-fluid ml-0 ml-md-2 ml-xl-3"></a>
                    <h5 id="tituloVentana">Llegó para quedarse</h5>
                </div>
            </div>

            <div class="modal-body modal-sesion-body">
                <div class="row mb-3">
                    <div class="col text-center">
                        <p>Gracias por participar en nuestra campaña gratuita por San Valentin pronto estaremos abriendo más opciones para sorprender</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>