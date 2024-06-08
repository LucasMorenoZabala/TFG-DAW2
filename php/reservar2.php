<?php
$controla = false;
include('lib.php');
include('config.php');

$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
    $msg = "<div class='alert alert-danger'>Necesitas estar registrado o tener tu sesión iniciada para hacer una reserva.</div>";
    echo $msg;
    echo "<script>
        setTimeout(function() {
            window.location.href = './login.php';
        }, 3000)
    </script>";
}

// Verifica si se ha proporcionado una fecha
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $idReservado = $_GET['id_reservado'];
    $idUsuario = $_POST['idusuario'];

    // Verificar si el usuario ya existe en la base de datos
    $comprobarUsuario = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ? AND email = ?");
    $comprobarUsuario->bind_param('ss', $usuario, $email);
    $comprobarUsuario->execute();
    $comprobarUsuario->bind_result($contado);
    $comprobarUsuario->fetch();
    $comprobarUsuario->close();

    if ($contado == 0) {
        $msg = "<div class='alert alert-danger'>Necesitas estar registrado para hacer una reserva.</div>";
        echo $msg;
        echo "<script>
        setTimeout(function() {
            window.location.href = './calendarioReservas.php';
        }, 3000)
        </script>";
    } else {
        if (!empty($usuario) && !empty($email) && !empty($date) && !empty($idReservado)) {
            $sql = $conexion->prepare("INSERT INTO reservas (nombre, email, fecha, id_reservado, idusuario) VALUES (?, ?, ?, ?, ?)");
            $sql->bind_param('sssii', $usuario, $email, $date, $idReservado, $idUsuario);
            $sql->execute();
            $msg = "<div class='alert alert-success'>Reservado correctamente</div>";

            echo $msg;
            echo "<script>
            setTimeout(function() {
                window.location.href = './calendarioReservas.php';
            }, 2000)
            </script>";
            $sql->close();
            $conexion->close();
        } else {
            $msg = "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
            echo $msg;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - 41100-Café&Copas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reservar2.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Reserva para: <?php echo date('d/m/Y', strtotime($date)) ?> </h1>
        <hr>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="">Nombre de usuario</label>
                        <input required type="text" class="form-control" name="usuario" <?php if (isset($_SESSION['usuario'])) {
                                                                                            echo 'value= "' . $_SESSION['usuario'] . '" readonly';
                                                                                        } ?>>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input required type="email" class="form-control" name="email" <?php if (isset($_SESSION['usuario'])) {
                                                                                            echo 'value= "' . $_SESSION['email'] . '" readonly';
                                                                                        } ?>>
                    </div>

                    <div class="form-group">
                        <input required type="hidden" class="form-control" name="idusuario" <?php if (isset($_SESSION['idusuario'])) {
                                                                                                echo 'value= "' . $_SESSION['idusuario'] . '"';
                                                                                            } ?>>
                    </div>

                    <div class="form-group">
                        <input required type="hidden" class="form-control" name="subject" value="Reserva confirmada.">
                    </div>

                    <div class="form-group">
                        <input required type="hidden" class="form-control" name="message" value='Tu reserva ha sido confirmada para el dia <?php echo $date; ?>.'>
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>