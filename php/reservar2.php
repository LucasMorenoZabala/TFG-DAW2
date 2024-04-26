<?php

$controla = false;
include('lib.php');
include('config.php');

$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);


if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $idReservado = $_GET['id_reservado'];
    $sql = $conexion->prepare("INSERT INTO reservas (nombre, email, fecha, id_reservado) VALUES (?, ? , ?, ?)");
    $sql->bind_param('sssi', $usuario, $email, $date, $idReservado);
    $sql->execute();
    $msg = "<div class = 'alert alert-success'>Reservado correctamente</div>";


    echo $msg;
    echo "    <script>
    setTimeout(function() {
        window.location.href = './calendarioReservas.php';
    }, 2000)
</script>";
    $sql->close();
    $conexion->close();
}






?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - 41100-Café&Copas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-2 {
            flex: 0 0 calc(20% - 10px);
            max-width: calc(20% - 10px);
            margin-bottom: 20px;
            margin-right: 10px;
        }

        .col-md-2:last-child {
            margin-right: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }


        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;

        }


        .btn:hover {
            background-color: #0056b3;

        }


        .btn-success {
            background-color: #28a745;

        }


        .btn-success:hover {
            background-color: #218838;

        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
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
                        <input required type="hidden" class="form-control" name="subject" value="Reserva confirmada.">
                    </div>

                    <div class="form-group">
                        <input required type="hidden" class="form-control" name="message" value='Tu reserva ha sido confirmada para el dia ".$date.".'>
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Enviar</button>


                </form>
            </div>
        </div>
    </div>
</body>

</html>