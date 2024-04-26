<?php
$controla = false;
include('lib.php');
include('config.php');



?>


<html>

<head>
    <title>41100-Café&Copas</title>
    <link rel="stylesheet" href="../css/reset-css.css" type="text/css">
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="../JavaScript/cookies.js"></script>
</head>

<body>

    <div id="cookies">
        <div class="container-cookies">
            <div class="subcontainer-cookies">
                <div class="cookies">
                    <p>This website uses cookies to ensure you get the best experience on our website. <a href="">Más información</a></p>
                    <button id="cookies-btn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="image">
        <section class="background-image1">
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
                    <a href="#footer">Contacto</a>
                    <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
                </div>
            </div>

            <div class="content">
                <h2>¿Todavía no tienes una mesa reservada?</h2>
                <a href="./calendarioReservas.php"><button>Reservar</button></a>
            </div>

            <div class="slider-box">
                <ul>
                    <li>
                        <img src="../img/29.jpg" alt="">

                    </li>


                    <li>
                        <img src="../img/31.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/32.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/33.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/34.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/35.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/36.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/37.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/38.jpg" alt="">

                    </li>

                    <li>
                        <img src="../img/39.jpg" alt="">

                    </li>

                </ul>
            </div>

        </section>
    </div>

    <div class="image">
        <section class="background-image2">
            <div class="content-nosotros">
                <h1>Sobre Nosotros</h1>
                <p>¿Quieres saber qué nos hace especiales?</p>
                <p>Descubre nuestra historia, nuestra misión y los valores que nos guían.</p>
                <a href="../php/conocenos.php" class="boton-conocenos">¡Conócenos!</a>
            </div>
        </section>
    </div>


    <div class="image">
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
    </div>




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


    <script>
        var mapa = L.map('mapa').setView([37.28098, -6.05019], 20);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        L.marker([37.28098, -6.05019]).addTo(mapa).bindPopup("41100-Café&Copas").openPopup();
    </script>

</body>

</html>