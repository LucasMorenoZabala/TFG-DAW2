<?php
$controla = false;
include("config.php");
include("lib.php");


$mensaje = "";


if (isset($_POST['usuario'], $_POST['email'], $_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
}


$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

$sql = 'INSERT INTO usuarios (usuario, email, clave) VALUES ("' . $_POST['usuario'] . '","' . $_POST['email'] . '", "' . $_POST['clave'] . '");';
$resultado = mysqli_query($conexion, $sql);


mysqli_close($conexion);
header("Location: ./index.php");
