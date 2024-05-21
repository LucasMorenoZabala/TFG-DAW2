<?php
$controla = false;
include("config.php");
include("lib.php");

if (isset($_POST['usuario'], $_POST['email'], $_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

    // Verificar si el usuario o el correo electrónico ya existen
    $sql_check = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = ? OR email = ?');
    $sql_check->bind_param('ss', $usuario, $email);
    $sql_check->execute();
    $sql_check->store_result();

    if ($sql_check->num_rows > 0) {
        echo "El nombre de usuario o el correo electrónico ya están registrados.";
    } else {
        //esto encripta la contraseña
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

        $sql = $conexion->prepare('INSERT INTO usuarios (usuario, email, clave) VALUES (?, ?, ?)');
        $sql->bind_param('sss', $usuario, $email, $clave_encriptada);
        $sql->execute();

        $sql->close();
        header("Location: ./login.php");
    }

    $conexion->close();
} else {
    $mensaje_error_registro = "Faltan datos para el registro.";
}
