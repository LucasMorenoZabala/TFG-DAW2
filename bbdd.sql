DROP DATABASE IF EXISTS tfg2;
CREATE DATABASE tfg2;
USE tfg2;

CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT,
    usuario VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    clave VARCHAR(100) NOT NULL,
    rol INT NOT NULL,
    PRIMARY KEY(idusuario)
);

CREATE TABLE reservas(
    idreserva INT AUTO_INCREMENT,
    fecha VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    id_reservado INT NOT NULL, 
    PRIMARY KEY(idreserva)
);

CREATE TABLE reservados(
    idreservado INT AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    PRIMARY KEY(idreservado)
);

CREATE TABLE slider(
    idSlider INT AUTO_INCREMENT,
    ruta VARCHAR(100) NOT NULL,
    vistaDesktop INT NOT NULL,
    PRIMARY KEY(idSlider)
);

CREATE TABLE bebidas(
    idbebida INT AUTO_INCREMENT,
    imagen VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
     PRIMARY KEY(idbebida)
);

CREATE TABLE fotos(
    idFoto INT AUTO_INCREMENT,
    foto VARCHAR(100) NOT NULL,
    PRIMARY KEY(idFoto)
);

--inserts de la galería
insert into fotos (foto) values ('../img/galeria1.jpg');
insert into fotos (foto) values ('../img/galeria2.jpg');
insert into fotos (foto) values ('../img/galeria3.jpg');
insert into fotos (foto) values ('../img/galeria4.jpg');
insert into fotos (foto) values ('../img/galeria5.jpg');
insert into fotos (foto) values ('../img/galeria6.jpg');
insert into fotos (foto) values ('../img/galeria7.jpg');
insert into fotos (foto) values ('../img/galeria8.jpg');
insert into fotos (foto) values ('../img/galeria9.jpg');
insert into fotos (foto) values ('../img/galeria10.jpg');
insert into fotos (foto) values ('../img/galeria11.jpg');
insert into fotos (foto) values ('../img/galeria12.jpg');
insert into fotos (foto) values ('../img/galeria13.jpg');
insert into fotos (foto) values ('../img/galeria14.jpg');
insert into fotos (foto) values ('../img/galeria15.jpg');
insert into fotos (foto) values ('../img/galeria16.jpg');
insert into fotos (foto) values ('../img/galeria17.jpg');
insert into fotos (foto) values ('../img/galeria18.jpg');
insert into fotos (foto) values ('../img/galeria19.jpg');
insert into fotos (foto) values ('../img/galeria20.jpg');
insert into fotos (foto) values ('../img/galeria21.jpg');
insert into fotos (foto) values ('../img/galeria22.jpg');
insert into fotos (foto) values ('../img/galeria23.jpg');
insert into fotos (foto) values ('../img/galeria24.jpg');
insert into fotos (foto) values ('../img/galeria25.jpg');
insert into fotos (foto) values ('../img/galeria26.jpg');
insert into fotos (foto) values ('../img/galeria27.jpg');
insert into fotos (foto) values ('../img/galeria28.jpg');
insert into fotos (foto) values ('../img/galeria29.jpg');
insert into fotos (foto) values ('../img/galeria30.jpg');
insert into fotos (foto) values ('../img/galeria31.jpg');
insert into fotos (foto) values ('../img/galeria32.jpg');
insert into fotos (foto) values ('../img/galeria33.jpg');
insert into fotos (foto) values ('../img/galeria34.jpg');
insert into fotos (foto) values ('../img/galeria35.jpg');
insert into fotos (foto) values ('../img/galeria36.jpg');
insert into fotos (foto) values ('../img/galeria37.jpg');
insert into fotos (foto) values ('../img/galeria38.jpg');
insert into fotos (foto) values ('../img/galeria39.jpg');
insert into fotos (foto) values ('../img/galeria40.jpg');
insert into fotos (foto) values ('../img/galeria41.jpg');
insert into fotos (foto) values ('../img/galeria42.jpg');
insert into fotos (foto) values ('../img/galeria43.jpg');
insert into fotos (foto) values ('../img/galeria44.jpg');
insert into fotos (foto) values ('../img/galeria45.jpg');
insert into fotos (foto) values ('../img/galeria46.jpg');
insert into fotos (foto) values ('../img/galeria47.jpg');
insert into fotos (foto) values ('../img/galeria48.jpg');
insert into fotos (foto) values ('../img/galeria49.jpg');
insert into fotos (foto) values ('../img/galeria50.jpg');

--inserts de las bebidas
insert into bebidas (imagen, nombre) values ('../img/red-label.jpg', 'Red Label');
insert into bebidas (imagen, nombre) values ('../img/Ballantines.jpg', 'Ballantines');
insert into bebidas (imagen, nombre) values ('../img/DYC.jpg', 'DYC');
insert into bebidas (imagen, nombre) values ('../img/Barcelo.jpg', 'Barceló');
insert into bebidas (imagen, nombre) values ('../img/Brugal.jpg', 'Brugal');
insert into bebidas (imagen, nombre) values ('../img/Cacique.jpg', 'Cacique');
insert into bebidas (imagen, nombre) values ('../img/Exotica.jpg', 'Exótica');
insert into bebidas (imagen, nombre) values ('../img/Larios12.jpg', 'Larios 12');
insert into bebidas (imagen, nombre) values ('../img/Seagram.jpg', 'Seagram');
insert into bebidas (imagen, nombre) values ('../img/Eristoff.jpg', 'Eristoff');

--inserts de las fotos del slider del index
insert into slider (ruta, vistaDesktop) values ('../img/29.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/31.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/32.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/33.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/34.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/35.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/36.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/37.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/38.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/39.jpg', 1);
insert into slider (ruta, vistaDesktop) values ('../img/8.png', 0);
insert into slider (ruta, vistaDesktop) values ('../img/23.png', 0);

--inserts de los reservados
insert into reservados (nombre) values ('Reservado 1');
insert into reservados (nombre) values ('Reservado 2');
insert into reservados (nombre) values ('Reservado 3');
insert into reservados (nombre) values ('Reservado 4');
insert into reservados (nombre) values ('Reservado 5');
insert into reservados (nombre) values ('Reservado 6');
insert into reservados (nombre) values ('Reservado 7');
insert into reservados (nombre) values ('Reservado 8');
insert into reservados (nombre) values ('Reservado 9');
insert into reservados (nombre) values ('Reservado 10');