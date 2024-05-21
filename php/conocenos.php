<?php

?>


<html>

<head>
    <title>41100-Café&Copas - Sobre Nosotros</title>
    <link rel="stylesheet" href="../css/conocenos.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="../JavaScript/menuHamburguesa.js" defer></script>
</head>

<body>

    <div class="image">
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
                        <a href="./index.php#footer">Contacto</a>
                        <a href="./trabajaConNosotros.php">Trabaja con nosotros</a>
                    </div>
                </div>
        </section>
    </div>




    <div class="about-section">
        <div class="inner-container">
            <h1>Nuestra historia</h1>

            <p class="text">Lo que comenzó como una simple broma entre amigos se convirtió en una gran aventura empresarial llena de desafíos y oportunidades. Desde el momento en que decidimos buscar un local, sabíamos que estábamos embarcándonos en algo único y especial.</p>

            <p class="text">A lo largo del camino, nos encontramos con desafíos que nunca habíamos imaginado, pero cada obstáculo se convirtió en una oportunidad para crecer y aprender. Cuando se presentó la posibilidad de transformar nuestro espacio en el mejor bar de copas, la emoción y el entusiasmo nos inundaron.</p>

            <p class="text">Hoy, miramos atrás con orgullo y alegría, recordando los días de trabajo duro y la pasión que hemos invertido en este proyecto. Nuestro bar de copas es más que un negocio, es un hogar para todos los que buscan un lugar donde puedan compartir momentos especiales con amigos y seres queridos. Te invitamos a ser parte de nuestra historia y a compartir la magia que hemos creado juntos.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>