<?php
session_start();

if ($controla) {
	if (!empty($_SESSION['idusuario'])) {
		$email = $_SESSION['email'];
	} else {
		header('Location: ./index.php');
	}
}

function conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto)
{
	if (!$conectado = mysqli_connect($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto)) {
		echo "Algo no va bien con la base de datos";
		exit;
	} else {
		//echo "conectado";
	}
	return $conectado;
}
