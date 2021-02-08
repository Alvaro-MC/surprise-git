<?php
ini_set('allow_url_fopen',1);
switch(@parse_url($_SERVER['REQUEST_URI'])['path']){
    case '/':
        require 'index.php';
        break;
    case '/index':
        require 'index.php';
        break;
    case '/index.php':
        require 'index.php';
        break;
    case '/cerrar.php':
        require 'cerrar.php';
        break;
    case '/registrar.php':
        require 'registrar.php';
        break;
    case '/surprise.php':
        require 'surprise.php';
        break;
    case '/me_surprise.php':
        require 'me_surprise.php';
        break;
    case '/modal.php':
        require 'modal.php';
        break;
    case '/registrar_invitacion.php':
        require 'registrar_invitacion.php';
        break;
    case '/registrar_video.php':
        require 'registrar_video.php';
        break;
    case '/home.php':
        require 'home.php';
        break;
    default:
        http_response_code(404);
        echo @parse_url($_SERVER['REQUEST_URI'])['path'];
        exit('Not Found');
}
