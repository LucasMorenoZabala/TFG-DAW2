<?php
$controla = false;
include("config.php");
include("lib.php");

if (isset($_POST['usuario'], $_POST['email'], $_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];


    //esto encripta la contraseña y luego le hago el insert ya con la contraseña hasheada
    $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

    $sql = $conexion->prepare('INSERT INTO usuarios (usuario, email, clave) VALUES (?, ?, ?)');
    $sql->bind_param('sss', $usuario, $email, $clave_encriptada);

    $sql->execute();

    $sql->close();

    header("Location: ./login.php");
} else {

    echo "Faltan datos para el registro.";
}
