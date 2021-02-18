<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

require_once 'modelo/conexion.php';

$query = null;

$resultAdd = false;

if ($_POST['correo']) {
    $correo = $_POST['correo'];

    $query = "select * from usuario where correo=:correo";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'correo' => $correo
    ]);
    $user = $prepared->fetch(PDO::FETCH_ASSOC);

    if (isset($user['id_usuario'])) {

        /* Variables para cifrado de correo */
        $string = $user['correo'];
        $method = 'aes128';
        $pass = "correo9para8cifrar7envio6por5la4url3";
        $iv = "e71865c3f21caf4a";

        /* Cifrado de correo */
        $cifradoEmail = openssl_encrypt($string, $method, $pass, false, $iv);
        $codigoEmailCifrado = base64_encode($cifradoEmail);
        $codeEmailCifrado = urlencode($codigoEmailCifrado);

        /* Variables para cifrar el token */
        $idToken = substr(md5(rand()), 0, 30);
        $idEncryptToken = password_hash($idToken, PASSWORD_DEFAULT);
        $method = 'aes128';
        $llave = $user['correo'] . $user['telefono'];
        $pass = password_hash($llave, PASSWORD_DEFAULT);
        $iv = substr(md5(rand()), 0, 16);

        /* Cifrado del Token */
        $cifradoToken = openssl_encrypt($idToken, $method, $pass, false, $iv);
        $codigoTokenCifrado = base64_encode($cifradoToken);
        $codeTokenCifrado = urlencode($codigoTokenCifrado);

        //Seteamos el token, iv_token y la llave en la BD para el usuario correspondiente
        $query = "update usuario set llave=:llave ,iv_token=:iv_token, token=:token where id_usuario=:id_usuario;";
        $queryResult = $pdo->prepare($query);
        $queryResult->execute([
            'llave' => $pass,
            'iv_token' => $iv,
            'token' => $idEncryptToken,
            'id_usuario' => $user['id_usuario']
        ]);

        $link_recovery = "https://surprise.com.pe/auth/pass_verify.php?em=".$codeEmailCifrado."&token=".$codeTokenCifrado;

        /* ************************************************************************************************************************ */
        /* Seteamos destinatario y demas campos */

        $remitente = 'hola@surprise.com.pe';
        $destinatario = $user['correo'];
        $subject = 'Recuperación de contraseña';
        $nameDest = $user['nombre'] . " " . $user['apellido'];


        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);


        /* ************************************************************************************************************************ */

        try {
            //Configuracion de remitente
            $mail->setFrom($remitente, 'Equipo de Surprise');
            $mail->addAddress($destinatario, $nameDest);

            // Content
            $mail->Subject = $subject;


            // Parametros SMTP

            /* Se indica que usaremos SMTP. */
            $mail->isSMTP();
            /* Direccion SMTP de servidor */
            $mail->Host = 'smtp.gmail.com';
            /* Usamos autenticacion SMTP */
            $mail->SMTPAuth = TRUE;
            /* Seteamos encriptacion de sistema */
            $mail->SMTPSecure = 'tls';
            /* Autenticacion SMTP de usuario. */
            $mail->Username = 'surprisemcperu@gmail.com';
            /* Autenticacion SMTP de pass */
            $mail->Password = 'surprise@2021';
            /* Seteamos el puerto */
            $mail->Port = 587;
            /* Seteamos configuracion de caracteres */
            $mail->CharSet = 'UTF-8';

            //CONFIGURACIÓN DEL MENSAJE, EL CUERPO DEL MENSAJE

            //Incrustamos IMG
            $mail->AddEmbeddedImage('css/img/logo.png', 'logo');
            $mail->AddEmbeddedImage('css/img/iconos/carita.png', 'carita');
            $mail->AddEmbeddedImage('css/img/iconos/car.svg', 'correo');
            $mail->AddEmbeddedImage('css/img/iconos/tel.svg', 'telefono');
            $mail->AddEmbeddedImage('css/img/iconos/map.svg', 'direccion');
            $mail->AddEmbeddedImage('css/img/iconos/fb.svg', 'fb');
            $mail->AddEmbeddedImage('css/img/iconos/insta.svg', 'insta');
            //Cargamos la plantilla html   
            $shtml = file_get_contents('plantilla.html');

            $cuerpo1 = str_replace('#nombre', $user['nombre'], $shtml);
            $cuerpo = str_replace('#link_recuperacion', $link_recovery, $cuerpo1);
            $mail->Body = $cuerpo; //cuerpo del mensaje
            $mail->AltBody = 'Si no puedes ver este mensaje, sigue este enlace para poder recuperar tu cuenta : ' . $link_recovery;

            $mail->send();
            $resultAdd = true;
        } catch (Exception $e) {
            // echo "Mensaje no enviado. Mailer Error: {$mail->ErrorInfo}";
            // echo $e->errorMessage();
            // echo $e->getMessage();
            echo '4';
        }
        /* ************************************************************************************************************************ */
    } else {
        echo '2';
    }

    if ($resultAdd) {
        echo '1';
    }
} else {
    echo '3';
}
