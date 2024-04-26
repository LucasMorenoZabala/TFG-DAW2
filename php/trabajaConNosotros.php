<?php
$controla = false;
include('lib.php');
include('config.php');

?>

<html>

<head>
    <title>Contacto - 41100-Café&Copas</title>
    <link rel="stylesheet" href="../css/trabajaConNosotros.css" type="text/css">
</head>

<body>
    <div class="container">
        <div class="fakeHeader">
            <div class="LogoDiv">
                <a href="index.php"><img src="../img/LOGO CAFE COPAS TRANSPARENTE.png" alt="Logo del bar 41100-Café&Copas"></a>
            </div>

            <div class="anchors">
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

        <div class="container-form">
            <header>
                <h1>Si quieres trabajar en el mejor bar de todo Sevilla, ¡deja aquí tu currículum!</h1>
            </header>

            <section class="contact-form">
                <form action="" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="file">Currículum Vitae: </label>
                    <input type="file" id="file" name="file" required>

                    <button type="submit">Enviar</button>
                </form>
            </section>
        </div>


    </div>
</body>

</html>