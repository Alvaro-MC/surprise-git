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

    if(isset($user['id_usuario'])){

        //Preparamos las variables correspondientes
        $email=$user['correo'];
        $method = 'aes128';
        $llave = $user['correo'].$user['telefono'];
        $pass = password_hash($llave, PASSWORD_DEFAULT);
        $iv = substr(md5(rand()), 0, 16);

        
        //Encriptamos el correo con su clave correspondiente
        $a = openssl_encrypt ($email, $method, $pass, false, $iv);
        $cod = base64_encode($a);
        $code = urlencode($cod);

        //Seteamos el token y el iv_token en la BD para el usuario correspondiente
        $query = "update usuario set token=:token, iv_token=:iv_token where id_usuario=:id_usuario;";
        $queryResult = $pdo->prepare($query);
        $queryResult->execute([
            'token' => $pass,
            'iv_token' => $iv,
            'id_usuario' => $user['id_usuario']
        ]);

        $link_recovery = "https://surprise.com.pe/auth/pass_verify.php?token=".$code;

        /* ************************************************************************************************************************ */
        /* Seteamos destinatario y demas campos */

        $remitente = 'hola@surprise.com.pe';
        $destinatario = $user['correo'];
        $subject = 'Recuperación de contraseña';
        $nameDest = $user['nombre']." ".$user['apellido'];


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
            $mail->AddEmbeddedImage('css/img/logo.png', 'imagen');
            //Cargamos la plantilla html   
            $shtml = file_get_contents('plantilla.html');

            $cuerpo = str_replace('#link_recuperacion', $link_recovery, $shtml);
            $mail->Body = $cuerpo; //cuerpo del mensaje
            $mail->AltBody = 'Si no puedes ver este mensaje, sigue este enlace para poder recuperar tu cuenta : '.$link_recovery;
        
            $mail->send();
            $resultAdd = true;
        } catch (Exception $e) {
            echo "Mensaje no enviado. Mailer Error: {$mail->ErrorInfo}";
            echo $e->errorMessage();
            echo $e->getMessage();
        }
        /* ************************************************************************************************************************ */

    }else{
        echo "Parece que no tenemos registrado ese correo, por favor intenta de nuevo";
    }

    if ($resultAdd) {
        echo "Le hemos enviado al correo un enlace de recuperación de contraseña";
    }
} else {
    echo "Por favor ingresar un correo válido";
}
