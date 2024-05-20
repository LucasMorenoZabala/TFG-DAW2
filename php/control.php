<?php
$controla = false;
include('config.php');
include('lib.php');

if (isset($_POST['usuario'], $_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

    $sql = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = ?');
    $sql->bind_param('s', $usuario);

    $sql->execute();
    $resultado = mysqli_stmt_get_result($sql);

    if (mysqli_num_rows($resultado) == 0) {
        $error = "El usuario no existe o se ha equivocado en alguno de los campos.";
        //error que se muestra en el login en caso de que alguno de los dos campos este mal.
        header('Location: ./login.php?error=' . urlencode($error));
    } else {
        $reg = mysqli_fetch_array($resultado);

        // esto verifica la contraseña que ha metido el usuario con la que esta codificada en la bbdd.
        if (password_verify($clave, $reg['clave'])) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['email'] = $reg['email'];
            $_SESSION['idusuario'] = $reg['idusuario'];
            $_SESSION['rol'] = $reg['rol'];
            header('Location: ./index.php');
        } else {
            $error = "Contraseña incorrecta.";
            header('Location: ./login.php?error=' . urlencode($error));
        }
    }

    $sql->close();
} else {
    //error por si no se han enviado correctamente los datos.
    echo "Faltan datos para el inicio de sesión.";
}
