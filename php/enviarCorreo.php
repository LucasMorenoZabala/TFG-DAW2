<?php

$mensaje_enviado = false;
if (isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['usuario']) && $_POST['usuario'] != '') {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $to = "lucasmorenozabala@gmail.com";
        $body = "";
        $body .= "From: " . $usuario . "\r\n";
        $body .= "Email: " . $email . "\r\n";
        $body .= "Mensaje: " . $message . "\r\n";

        mail($to, $subject, $message);

        $mensaje_enviado = true;
    }
}
