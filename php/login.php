<?php
$controla = false;
include('config.php');
include('lib.php');


?>

<html>

<head>
    <title>Inicio de sesión - 41100-Café&Copas</title>
    <link rel="stylesheet" href="../css/login.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../JavaScript/comprobaciones.js"></script>
</head>

<body>
    <div class="fakeHeader">
        <div class="LogoDiv">
            <a href="index.php"><img src="../img/LOGO CAFE COPAS TRANSPARENTE.png" alt="Logo del bar 41100-Café&Copas"></a>
        </div>

        <div class="anchors">
            <a href="./login.php">Inicia sesión</a>
            <a href="./carta.php">Carta</a>
            <a href="./index.php#footer">Contacto</a>
            <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
        </div>
    </div>


    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="../php/control.php" method="POST" class="sign-in-form" autocomplete="off">
                    <h2 class="title">Inicia sesión</h2>
                    <div class="input-field">
                        <i class="bx bx-user"></i>
                        <input type="text" placeholder="Usuario" name="usuario" id="usuario">
                    </div>

                    <div class="input-field">
                        <i class="bx bx-lock-alt"></i>
                        <input type="password" placeholder="Contraseña" name="clave" id="clave">
                    </div>
                    <input type="hidden" name="idusuario" id="idusuario">

                    <input type="submit" class="btn solid" value="Inicia sesión">

                    <p class="social-text">O inicia sesión con tus redes sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="bx bxl-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-github"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-linkedin-square"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-gmail"></i>
                        </a>

                        <a href="#" class="social-icon">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </div>
                </form>



                <form action="../php/registro.php" method="POST" class="sign-up-form" autocomplete="off">
                    <h2 class="title">Registrate</h2>
                    <div class="input-field">
                        <i class="bx bx-user"></i>
                        <input type="text" placeholder="Usuario" name="usuario" id="usuario">
                    </div>

                    <div class="input-field">
                        <i class="bx bx-envelope"></i>
                        <input type="text" placeholder="Email" name="email" id="email">
                    </div>

                    <div class="input-field">
                        <i class="bx bx-lock-alt"></i>
                        <input type="password" placeholder="Contraseña" name="clave" id="clave">
                    </div>
                    <input type="hidden" name="idusuario" id="idusuario">

                    <input type="submit" class="btn solid" value="Regístrate">

                    <p class="social-text">O registrate con tus redes sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="bx bxl-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-github"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-linkedin-square"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bx bxl-gmail"></i>
                        </a>

                        <a href="#" class="social-icon">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </div>
                </form>

            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>¿Nuevo por aquí?</h3>
                        <p>Si todavía no te has unido a nuestra comunidad, ¡aún estás a tiempo!</p>
                        <button class="btn transparent" id="sign-up-btn">Regístrate</button>
                    </div>

                    <img src="../img/InicioSesionSVG.svg" class="image">
                </div>

                <div class="panel right-panel">
                    <div class="content">
                        <h3>¿Ya perteneces a la comunidad del 41100?</h3>
                        <p>Si ya perteneces a nuestra comunidad, ¡inicia sesión y disfruta de nuestro contenido!</p>
                        <button class="btn transparent" id="sign-in-btn">Inicia sesión</button>
                    </div>

                    <img src="../img/InicioSesion2SVG.svg" class="image">
                </div>
            </div>
        </div>
    </div>

    <script src="../JavaScript/Cambio_IS_RE.js"></script>
    <script src="../JavaScript/comprobaciones.js"></script>
</body>

</html>