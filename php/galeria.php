<?php
$controla = false;
include('lib.php');
include('config.php');


$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);




$sql = $conexion->prepare('select * from fotos');
$fotos = array();
if ($sql->execute()) {
    $resultado = $sql->get_result();
}

?>


<html>

<head>
    <title>41100-Café&Copas - Galería</title>
    <link rel="stylesheet" href="../css/reset-css.css" type="text/css">
    <link rel="stylesheet" href="../css/galeria.css" type="text/css">
</head>

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
    </section>
</div>



<div class="full-img" id="fullImgBox">
    <img src="../img/fondo2.jpg" id="fullImg">
    <span onclick="closeFullImg()">X</span>
</div>




<div class="img-gallery">
    <?php

    if ($resultado->num_rows > 0) {
        while ($filas = $resultado->fetch_assoc()) {
            echo '<div class="full-img" id="fullImgBox">
            <img src="' . $filas['foto'] . '" id="fullImg">
            <span onclick="openFullImg(this.src)"></span>
            </div>';
        }
        $sql->close();
    }
    ?>
</div>

<script>
    var fullImgBox = document.getElementById("fullImgBox");
    var fullImg = document.getElementById("fullImg");

    function openFullImg(picture) {
        fullImgBox.style.display = "flex";
        fullImg.src = picture;
    }

    function closeFullImg() {
        fullImgBox.style.display = "none";
    }
</script>

</html>