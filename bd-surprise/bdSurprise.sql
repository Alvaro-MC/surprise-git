CREATE DATABASE bdsurprise;
USE bdsurprise;

CREATE TABLE usuario(
	id_usuario int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40) NOT NULL,
    apellido varchar(40) NOT NULL,
    correo varchar(50) NOT NULL UNIQUE,
    telefono varchar(11) NOT NULL,
    contrasena TEXT NOT NULL
);

CREATE TABLE panel(
    id_panel int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40),
    ubicacion text NOT NULL,
    tipo varchar(20),
    descripcion text,
    stock_videos int NOT NULL
);

CREATE TABLE video(
    id_video int AUTO_INCREMENT PRIMARY KEY,
    ubicacion varchar(60) NOT NULL,
    fecha DATE NOT NULL,
    mensaje TEXT,
    nro_video INT,
    id_usuario int NOT NULL,
    id_panel int NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_panel) REFERENCES panel(id_panel)
    ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE invitacion(
    id_invitacion int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40) NOT NULL,
    apellido varchar(40) NOT NULL,
    telefono varchar(11) NOT NULL,
    mensaje TEXT NOT NULL,
    url TEXT NOT NULL UNIQUE,
    id_usuario int NOT NULL,
    id_video int NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_video) REFERENCES video(id_video)
    ON DELETE CASCADE ON UPDATE CASCADE
);

#################### POR AGREGAR ####################
insert into panel(nombre,ubicacion,tipo,descripcion,stock_videos) values (:nombre,:apellido,:telefono,:mensaje,:url,:id_usuario,:id_video);
