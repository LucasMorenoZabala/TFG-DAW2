<?php
$controla = false;
include('lib.php');
include('config.php');


$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);


if (isset($_GET['idFoto'])) {
    $idFoto = $_GET['idFoto'];

    $borrar = $conexion->prepare('DELETE FROM fotos WHERE idFoto = ?');
    $borrar->bind_param('i', $idFoto);

    if ($borrar->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo 'Ha habido un problema al eliminar la foto';
    }
    $borrar->close();
}

if (isset($_POST['idFoto'], $_POST['nueva_ruta'])) {
    $idFoto = $_POST['idFoto'];
    $nuevaRuta = $_POST['nueva_ruta'];

    modificarFoto($idFoto, $nuevaRuta, $conexion);
}

function modificarFoto($idFoto, $nuevaRuta, $conexion)
{
    $modificar = $conexion->prepare('UPDATE fotos SET foto = ? WHERE idFoto = ?');
    $modificar->bind_param('si', $nuevaRuta, $idFoto);
    $resultado = $modificar->execute();


    if ($resultado) {
        echo "La foto se ha modificado correctamente.";
    } else {
        echo "Ha habido un problema al cambiar la foto.";
    }
    $modificar->close();
}


if (isset($_GET['rutaAnadir'])) {
    $rutaAnadir = $_GET['rutaAnadir'];

    anadirFoto($rutaAnadir, $conexion);
}

function anadirFoto($rutaAnadir, $conexion)
{
    $anadir = $conexion->prepare('INSERT INTO fotos (foto) VALUES (?)');
    $anadir->bind_param('s', $rutaAnadir);
    $resultado = $anadir->execute();

    if ($resultado) {
        echo "La foto se ha insertado correctamente.";
    } else {
        echo "Ha habido un problema al insertar la foto.";
    }
    $anadir->close();
}


?>


<html>

<head>
    <title>41100-Café&Copas - Galería</title>
    <link rel="stylesheet" href="../css/reset-css.css" type="text/css">
    <link rel="stylesheet" href="../css/galeria.css" type="text/css">
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



        <div class="img-gallery">
            <?php
            $sql = $conexion->prepare('select * from fotos');
            if ($sql->execute()) {
                $resultado = $sql->get_result();
            }
            if ($resultado->num_rows > 0) {
                while ($filas = $resultado->fetch_assoc()) {
                    echo '<div class="full-img" id="fullImgBox">
            <img src="' . $filas['foto'] . '" id="fullImg" onclick="openFullImg(this.src)">';

                    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
                        echo '<div class="action-buttons">
                    <button class="btn btn-modificar" onclick="modificar(' . $filas['idFoto'] . ')">Modificar foto</button>
                    <button class="btn btn-danger" onclick="borrar(' . $filas['idFoto'] . ')">Borrar foto</button>
                </div>';
                    }

                    echo '</div>';
                }
                $sql->close();
            }


            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
                echo '<div class="anadir-image">
            <button class="btn btn-anadir" onclick="anadir()">Añadir imagen</button>
        </div>';
            }
            ?>
        </div>







        <script>
            function openFullImg(src) {

                var imgGallery = document.createElement("div");
                imgGallery.id = "overlay";
                imgGallery.style.position = "fixed";
                imgGallery.style.top = "0";
                imgGallery.style.left = "0";
                imgGallery.style.width = "100%";
                imgGallery.style.height = "100%";
                imgGallery.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
                imgGallery.style.display = "flex";
                imgGallery.style.justifyContent = "center";
                imgGallery.style.alignItems = "center";


                var fullImg = document.createElement("img");
                fullImg.src = src;
                fullImg.style.maxWidth = "90%";
                fullImg.style.maxHeight = "90%";


                imgGallery.appendChild(fullImg);


                document.body.appendChild(imgGallery);


                imgGallery.onclick = function() {
                    document.body.removeChild(imgGallery);
                };
            }
        </script>

        <script>
            function borrar(idFoto) {
                if (confirm("¿Estás seguro de querer borrar esta foto?")) {
                    fetch('<?php echo $_SERVER['PHP_SELF'] ?>?idFoto=' + idFoto, {
                            method: "GET"
                        })
                        .then(Response => {
                            if (!Response.ok) {
                                throw new Error('Ha habido un problema al eliminar la foto.')
                            }
                            return Response.text();
                        })
                        .then(data => {
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Error: ', error);
                            alert('Ha habido otro problema al eliminar la foto.')
                        });
                }
            }
        </script>

        <script>
            function modificar(idFoto) {
                var nuevaRuta = prompt("Meta la nueva ruta de la foto.");
                if (nuevaRuta !== null) {
                    fetch('<?php echo $_SERVER['PHP_SELF'] ?>', {
                            method: 'POST',
                            headers: {
                                'Content-type': 'application/x-www-form-urlencoded'
                            },
                            body: 'idFoto=' + idFoto + '&nueva_ruta=' + nuevaRuta
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
                            alert('Ha habido un problema modificando la foto.');
                        })
                }
            }
        </script>

        <script>
            function anadir() {
                var rutaAnadir = prompt("Meta la ruta de la foto.");
                if (rutaAnadir !== null) {
                    fetch('<?php echo $_SERVER['PHP_SELF'] ?>?rutaAnadir=' + rutaAnadir, {
                            method: 'GET',
                        })

                        .then(Response => {
                            if (!Response.ok) {
                                throw new Error('Ha habido un error al insertar la foto.');
                            }
                            return Response.text();
                        })
                        .then(data => {
                            location.reload();
                        })
                        .catch(error => {
                            console.log('Error: ', error);
                            alert('Ha habido un problema insertado la foto.');
                        })
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>