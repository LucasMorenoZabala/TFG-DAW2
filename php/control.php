<?php
$controla = false;
include('config.php');
include('lib.php');

$hayUsuario = false;
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

// Crear conexión
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Preparar el string que contendrá la instrucción SQL
$sql = 'SELECT * FROM usuarios WHERE usuario="' . $usuario . '" AND clave="' . $clave . '";';

// Enviar la consulta al servidor MySQL a través de la conexión creada, y almacenar resultado en una variable
$consulta = mysqli_query($conexion, $sql);

// Verificar si hay algún usuario como resultado
// Si no hay usuario (consulta vacía), redireccionamos a index.php
// Si hay usuario (hay registros en la consulta recibida), redireccionamos a portada.php
$cuantos = mysqli_num_rows($consulta); // Almacenamos en $cuantos la cantidad de filas recogidas en la consulta
if ($cuantos == 0) {
    $error = "El usuario no existe o se ha equivocado en alguno de los dos campos.";
    header('Location: ./login.php?error=' . urlencode($error)); // Al no haber usuario recogido, la identificación no es correcta. Redireccionamos a index.php
} else {
    $reg = mysqli_fetch_array($consulta); // Almacenamos en $reg el array con los datos del usuario que están en la consulta
    $_SESSION['usuario'] = $usuario; // Creamos la variable de sesión 'usuario' para que sea accesible en todas las páginas en las que se inicie sesión.
    $_SESSION['email'] = $reg['email'];
    $_SESSION['idusuario'] = $reg['idusuario'];
    $_SESSION['rol'] = $reg['rol'];
    header('Location: ./index.php');
}
