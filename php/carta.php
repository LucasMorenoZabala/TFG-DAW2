<?php
$controla = false;
include('lib.php');
include('config.php');


$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);
?>

<html>

<head>
    <title>Carta - 41100-Café-Copas</title>
    <link rel="stylesheet" href="../css/carta.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="../JavaScript/menuHamburguesa.js" defer></script>
</head>

<body>

    <div class="image">
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
    </div>


    <div class="container">
        <form action="" method="get" class="search-bar" autocomplete="off">
            <input type="text" placeholder="Busca nuestras bebidas" name="buscador" id="buscador">
            <button type="submit"><img src="../img/lupa2.png" alt="Imagen de la lupa"></button>
        </form>


        <?php if (isset($_GET['buscador']) && !empty($_GET['buscador'])) {

            $bebida = $_GET['buscador'];


            $sql = "SELECT * FROM bebidas WHERE nombre LIKE '%$bebida%'";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado->num_rows > 0) {
                echo "<div class= 'filtrado'>";
                while ($filas = $resultado->fetch_assoc()) {
                    echo "<div class = 'resultado'>";
                    echo '<img src="' . $filas["imagen"] . '" alt="' . $filas["nombre"] . '">';
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No se ha encontrado una bebida con ese nombre.</p>";
            }
        }
        $conexion->close();
        ?>

        <section class="container-photos">
            <div class="slider-wrapper">
                <div class="slider">
                    <img id="slide-1" src="../img/bebidas.JPG" alt="Bebidas del bar.">
                    <img id="slide-2" src="../img/botella.JPG" alt="Botellas que puedes pedir en el bar.">
                </div>

                <div class="slider-nav">
                    <a href="#slide-1"></a>
                    <a href="#slide-2"></a>
                </div>
            </div>
        </section>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>