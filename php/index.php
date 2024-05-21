<?php
$controla = false;
include('lib.php');
include('config.php');

$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

$sql = $conexion->prepare('select * from slider');
if ($sql->execute()) {
    $resultado = $sql->get_result();
}
$sql->close();


?>


<html>

<head>
    <title>41100-Café&Copas</title>
    <link rel="stylesheet" href="../css/reset-css.css" type="text/css">
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../JavaScript/cookies.js" defer></script>
    <script src="../JavaScript/menuHamburguesa.js" defer></script>
    <script src="../JavaScript/carousel.js" defer></script>
</head>

<body>


    <div class="wrapper">
        <header>
            <i class="bx bx-cookie"></i>
            <h2>Consentimiento de las cookies</h2>
        </header>

        <div class="data">
            <p>Este sitio web utiliza cookies para ayudarte a tener una experiencia de navegación superior y más relevante en el sitio web. <a href="#">Leer más...</a> </p>
        </div>

        <div class="buttons">
            <button class="button" id="acceptBtn">Aceptar</button>
            <button class="button">Declinar</button>
        </div>
    </div>



    <section class="background-image1">
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
                    <a href="#footer">Contacto</a>
                    <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
                </div>
            </div>
        </div>

        <div class="content">
            <h2>¿Todavía no tienes una mesa reservada?</h2>
            <a href="./calendarioReservas.php"><button>Reservar</button></a>
        </div>

        <div class="izq-image">
            <img src="../img/8.png" alt="">
        </div>

        <div class="container-carousel">
            <div class="carouseles desktop" id="slider">
                <?php
                if ($resultado->num_rows > 0) {
                    while ($filas = $resultado->fetch_assoc()) {
                        if ($filas['vistaDesktop'] == 1) {
                            echo "<section class='slider-section'>
                            <img src = " . $filas['ruta'] . ">
                            </section>";
                        }
                    }
                }
                ?>
            </div>
            <div class="btn-left">
                <i class='bx bxs-left-arrow'></i>
            </div>

            <div class="btn-right">
                <i class='bx bxs-right-arrow'></i>
            </div>

            <div class="carouseles mobile" id="slider1">
                <?php
                $resultado->data_seek(0);
                if ($resultado->num_rows > 0) {
                    while ($filas = $resultado->fetch_assoc()) {
                        echo "<section class='slider-section1'>
                                                <img src = " . $filas['ruta'] . ">
                                                </section>";
                    }
                }
                ?>
            </div>
            <div class="btn-leftMobile">
                <i class='bx bxs-left-arrow'></i>
            </div>
            <div class="btn-rightMobile"><i class='bx bxs-right-arrow'></i></div>
        </div>
        <div class="der-image">
            <img src="../img/23.png" alt="">
        </div>
    </section>

    <section class="background-image2">
        <div class="content-nosotros">
            <h1>Sobre Nosotros</h1>
            <p>¿Quieres saber qué nos hace especiales?</p>
            <p>Descubre nuestra historia, nuestra misión y los valores que nos guían.</p>
            <a href="../php/conocenos.php" class="boton-conocenos">¡Conócenos!</a>
        </div>
    </section>


    <section class="background-image3">
        <div class="content-Galeria">
            <h1>GALERÍA</h1>
            <p>
                Las fotos son un soplo de aire fresco lo que fue y lo que pronto será. En 41100-Café & Copas nos gusta mirarlas y recordar las ganas que tenemos de volver a veros y disfrutar como siempre.
                Revive las mejores noches de 41100-Café & Copas a través de nuestra galería de fotos.
            </p>
            <a href="./galeria.php"><button>Ver fotos</button></a>
        </div>
    </section>


    <footer id="footer">
        <div class="rrss">
            <h2>¡Puedes contactar conmigo através de estas redes sociales!</h2>
            <a href="https://github.com/LucasMorenoZabala"><img src="../img/github.png" alt="Foto de github"></a>

            <a href="https://www.linkedin.com/in/lucas-moreno-4b539827a/"><img src="../img/social.png" alt="Foto de linkedIn"></a>

            <a href="https://www.instagram.com/lucasmooreeno/?hl=es"><img src="../img/instagram.png" alt="Foto de instagram"></a>

            <a href="https://twitter.com/Luucasmz03"><img src="../img/logotipo-de-twitter.png" alt="Foto de twitter"></a>

            <a href="mailto:lucasmorenozabala@gmail.com"><img src="../img/gmail.png" alt="Foto de gmail"></a>
        </div>

        <p class="texto">¡Puedes encontrarnos en <span class="span">Paseo Carlos de Mesa,</span> justo debajo!</p>
        <div class="mapa" id="mapa"></div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var mapa = L.map('mapa').setView([37.28098, -6.05019], 20);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        L.marker([37.28098, -6.05019]).addTo(mapa).bindPopup("41100-Café&Copas").openPopup();
    </script>

</body>

</html>