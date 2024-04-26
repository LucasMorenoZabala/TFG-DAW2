<?php
$controla = false;
include('lib.php');
include('config.php');
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

if (isset($_GET['idreserva'])) {
    $idreserva = $_GET['idreserva'];
    echo $idreserva;
    $sql = $conexion->prepare('DELETE FROM reservas WHERE idreservas = ?');
    $sql->bind_param('i', $idreserva);

    if ($sql->execute()) {
        echo "Reserva eliminada correctamente";
    } else {
        echo "Hubo un error al eliminar la reserva: " . $conexion->error;
    }

    $sql->close();
}

//Confirmar que el boton de borrar se ha pulsado
if (isset($_POST['borrar'])) {
    $idreserva = $_POST['idreserva'];

    borrarReserva($conexion, $idreserva);
}
