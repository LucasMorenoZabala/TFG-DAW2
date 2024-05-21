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


    if (isset($_GET['idreserva']) && isset($_GET['action']) && $_GET['action'] === "borrar") {
        $idreserva = $_GET['idreserva'];

        $borrar = $conexion->prepare('DELETE FROM reservas WHERE idreserva = ?');
        $borrar->bind_param('i', $idreserva);

        if ($borrar->execute()) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo 'Ha habido un problema al eliminar la reserva';
        }
        $borrar->close();
    }


    if (isset($_GET['action']) && $_GET['action'] === "modificar") {
        $idreserva = $_GET['idreserva'];
        $nuevaFecha = $_GET['nueva_fecha'];

        $modificar = $conexion->prepare('UPDATE reservas SET fecha = ? WHERE idreserva = ?');
        $modificar->bind_param('si', $nuevaFecha, $idreserva);
        $resultado = $modificar->execute();

        if ($resultado) {
            echo "La fecha se ha modificado correctamente.";
        } else {
            echo "Ha habido un problema al cambiar la fecha.";
        }
        $modificar->close();
        return "Se ha reservado correctamente";
        die();
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
    <link rel="stylesheet" href="../css/calendarioReservas.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="../JavaScript/menuHamburguesa.js" defer></script>
</head>

<body>




    <div class="fakeHeader">
        <div class="LogoDiv">
            <a href="index.php"><img src="../img/LOGO CAFE COPAS TRANSPARENTE.png" alt="Logo del bar 41100-Café&Copas"></a>
        </div>

        <nav>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<a href="./salir.php" class= "btn-salir">Salir de la sesión</a>';
            } else {
                echo '<a href="./login.php">Inicia sesión</a>';
            }
            ?>

            <a href="./carta.php">Carta</a>
            <a href="./index.php#footer">Contacto</a>
            <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
        </nav>

        <div class="menuWrapper">
            <img src="../img/menu.png" alt="hamburguer menu" style="width: 40px;" class="burgerMenu">
            <div class="menuNav">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<a href="./salir.php" class= "btn-salir">Salir de la sesión</a>';
                } else {
                    echo '<a href="./login.php">Inicia sesión</a>';
                }
                ?>

                <a href="./carta.php">Carta</a>
                <a href="./index.php#footer">Contacto</a>
                <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
            </div>
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
            echo "<li>" . $reg['nombre'] . " con email " . $reg['email'] . ", ha reservado el " . $reg['fecha'] . " y ha reservado el reservado " . $reg['id_reservado'] . ". ";


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
    </script>

    <script>
        function borrar(idreserva) {
            if (confirm("¿Estás seguro de querer borrar esta reserva?")) {
                fetch('<?php echo $_SERVER['PHP_SELF'] ?>?idreserva=' + idreserva + "&action=borrar", {
                        method: "GET"
                    })
                    .then(Response => {
                        if (!Response.ok) {
                            throw new Error('Ha habido un problema al eliminar la reserva.')
                        }
                        return Response.text();
                    })
                    .then(data => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                        alert('Ha habido otro problema al eliminar la reserva.')
                    });
            }
        }
    </script>

    <script>
        function modificar(idreserva) {
            var nuevaFecha = prompt("Meta la nueva fecha de reserva (AAAA-MM-DD)");
            var hoy = new Date().toISOString().slice(0, 10);
            if (nuevaFecha !== null) {
                if (nuevaFecha >= hoy) {
                    fetch('<?php echo $_SERVER['PHP_SELF'] ?>?idreserva=' + idreserva + '&nueva_fecha=' + nuevaFecha + "&action=modificar", {
                            method: 'GET',
                        })
                        .then(Response => {
                            if (!Response.ok) {
                                throw new Error('Ha habido un error al modificar la reserva.');
                            }
                            return Response.text();
                        })
                        .then(data => {
                            location.reload();
                        })
                        .catch(error => {
                            console.log('Error: ', error);
                            alert('Ha habido un problema modificando la reserva.');
                        });
                } else {
                    alert("La fecha modificada no puede ser anterior al día actual.")
                }

            }
        }
    </script>
</body>

</html>