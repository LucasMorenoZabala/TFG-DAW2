<?php
$controla = false;
include('lib.php');
include('config.php');
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

function calendario($month, $year, $conexion, $reservado)

{
    $sql = $conexion->prepare('select * from reservados');
    $reservados = "";
    $primer_reservado = 0;
    $i = 0;
    if ($sql->execute()) {
        $resultado = $sql->get_result();
        if ($resultado->num_rows > 0) {
            while ($filas = $resultado->fetch_assoc()) {
                if ($i == 0) {
                    $primer_reservado = $filas['idreservado'];
                }

                $reservados .= "<option value=" . $filas['idreservado'] . ">" . $filas['nombre'] . "</option>";
                $i++;
            }

            $sql->close();
        }
    }

    if ($reservado != 0) {
        $primer_reservado = $reservado;
    }


    $sql = $conexion->prepare('select * from reservas WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND id_reservado = ?');
    $sql->bind_param('ssi', $month, $year, $primer_reservado);
    $reservas = array();
    if ($sql->execute()) {
        $resultado = $sql->get_result();
        if ($resultado->num_rows > 0) {
            while ($filas = $resultado->fetch_assoc()) {
                $reservas[] = $filas['fecha'];
            }
            $sql->close();
        }
    }

    function borrarReserva($conexion, $idreserva)
    {
    }



    $daysOfWeek = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = ($dateComponents['wday'] + 6) % 7;

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    $nex_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));

    $dateToday = date('Y-m-d');


    $calendar = "<center><h2 class = 'calendar-header'>$monthName $year</h2>";

    $calendar .= "<a class='btn btn-prev' href='?month=" . $prev_month . "&year=" . $prev_year . "'>Mes anterior</a>";

    $calendar .= "<a class='btn btn-current' href='?month=" . date('m') . "&year=" . date('Y') . "'>Mes actual</a>";

    $calendar .= "<a class='btn btn-next' href='?month=" . $nex_month . "&year=" . $next_year . "'>Mes siguiente</a></center>";

    $calendar .= "
    <form id='reservado_select_form'>
        <div class='row'>
            <div class='col-md-6 col-md-offset-3 form-group'>
                <label>Selecciona un reservado</label>
                <select class='form-control' id='reservado_select' name = 'reservado'>
                    " . $reservados . "
                </select>
                <input type = 'hidden' name= 'month' value = '" . $month . "'>
                <input type = 'hidden' name= 'year' value = '" . $year . "'>
            </div>
        </div>
    </form>
    
    
    
    <table class = 'table'>";

    $calendar .= "<tr>";



    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class = 'header'>$day</th>";
    }

    $calendar .= "</tr><tr>";
    $currentDay = 1;
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class = 'empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $today = $date == date('Y-m-d') ? "today" : "";
        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class = 'btn btn-danger'>N/A</button>";
        } elseif (in_array($date, $reservas)) {
            $calendar .= "<td><h4>$currentDay</h4> <button class = 'btn btn-danger'>Ya está reservado</button>";
        } else {
            $calendar .= "<td class ='$today'><h4>$currentDay</h4> <a href= 'reservar2.php?date=" . $date . "&id_reservado=" . $primer_reservado . "' class = 'btn btn-success'>Reservar</a> ";
        }


        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek < 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td> ";
        }
    }

    $calendar .= "</tr></table>";

    return $calendar;
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Calendario de reservas - 41100-Café&Copas</title>
    <link rel="stylesheet" href="../css/reservar.css" type="text/css">

    <style>
        .table {
            table-layout: fixed;
            border: 1px solid #ccc;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        td {
            width: 33%;
            border: 1px solid #ccc;
            padding: 8px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
        }

        .btn-prev {
            background-color: #f44336;
        }

        .btn-current {
            background-color: #2196f3;
        }

        .btn-next {
            background-color: #4CAF50;
        }

        .btn.btn-success {
            background-color: #28a745;
            color: white;
        }


        .btn.btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn.btn-modificar {
            background-color: rgb(255, 165, 0);
            color: white;
        }

        .adminReservas {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .adminReservas ul {
            list-style-type: none;
            padding: 0;
        }

        .adminReservas li {
            margin-bottom: 5px;
            padding: 5px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .today {
            background-color: #ffc107;
        }

        .empty {
            background-color: #f2f2f2;
        }

        .form-group {
            margin-bottom: 20px;
            margin-top: 20px;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;

        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            justify-content: center;
            align-items: center;
            color: #555;
        }

        .form-control {
            width: 20%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
    </style>
</head>

<body>




    <div class="fakeHeader">
        <div class="LogoDiv">
            <a href="index.php"><img src="../img/LOGO CAFE COPAS TRANSPARENTE.png" alt="Logo del bar 41100-Café&Copas"></a>
        </div>

        <div class="anchors">
            <a href="./login.php">Inicia sesión</a>
            <a href="./carta.php">Carta</a>
            <a href="#footer">Contacto</a>
            <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }

                if (isset($_GET['reservado'])) {
                    $reservado = $_GET['reservado'];
                } else {
                    $reservado = 0;
                }
                echo calendario($month, $year, $conexion, $reservado);

                ?>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
        $controla = false;

        $stmt = $conexion->prepare("SELECT * from reservas");
        $stmt->execute();

        echo "<div class='adminReservas'>";
        echo "<ul>";

        $resultado2 = $stmt->get_result();

        while ($reg = $resultado2->fetch_assoc()) {
            echo "<li>" . $reg['nombre'] . " con email " . $reg['email'] . ", ha reservado el " . $reg['fecha'] . " ";


            echo "<button class='btn btn-modificar' onclick='modificar(" . $reg['idreserva'] . ")'>Modificar reserva</button>";


            echo "<button class='btn btn-danger' onclick='borrar(" . $reg['idreserva'] . ")'>Borrar reserva</button>";

            echo "</li>";
        }

        echo "</ul>";

        echo "</div>";
    }
    ?>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("#reservado_select").change(function() {
            $("#reservado_select_form").submit();
        });

        $("#reservado_select option[value='<?php echo $reservado ?>']").attr('selected', 'selected');


        function borrar(idreserva) {
            if (confirm("¿Estás seguro de que quieres eliminar esta reserva?")) {
                fetch('./borrarReserva.php?id=' + idreserva, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            idreserva: idreserva
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('No se ha podido eliminar la reserva.');
                        }
                        return response.text();
                    })
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ha habido un error al intentar borrar la reserva.');
                    });
            }
        }
    </script>

</body>

</html>