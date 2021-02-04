CREATE DATABASE bdsurprise;
USE bdsurprise;

CREATE TABLE usuario(
	id_usuario int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40) NOT NULL,
    apellido varchar(40) NOT NULL,
    correo varchar(50) NOT NULL UNIQUE,
    telefono varchar(11) NOT NULL,
    contrasena TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
    ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE panel(
    id_panel int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40),
    ubicacion text NOT NULL,
    tipo varchar(20),
    descripcion text,
    stock_videos int NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
    ON UPDATE CURRENT_TIMESTAMP
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
    ON DELETE RESTRICT ON UPDATE CASCADE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
    ON UPDATE CURRENT_TIMESTAMP
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
    ON DELETE CASCADE ON UPDATE CASCADE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
    ON UPDATE CURRENT_TIMESTAMP
);


insert into panel(nombre,ubicacion,tipo,descripcion,stock_videos)
values
('Panel Parque Eterno','Av.Chan Chan (Altura Camposanto Parque Eterno) - HUANCHACO','Paradero','1024px X 384px',0),
('Panel La Esperanza','Av.José G. Condorcanqui Cdra 10 - LA ESPERANZA','Paradero','1024px X 384px',0),
('Panel La Esperanza','Av.José G. Condorcanqui Cdra 12 - LA ESPERANZA','Paradero','1024px X 384px',0),
('Panel Mall Aventura','Av.América oeste Cuadra 7 - MALL AVENTURA','Paradero','1024px X 384px',0),
('Panel El Golf','Prol.Vallejo con Av.El golf - VICTOR LARCO','Pórtico','540px de ancho x 1080px de alto',0),
('Panel Av. Fátima','Av.Larco con A.Fátima - VICTOR LARCO','Pórtico','540px de ancho x 1080px de alto',0),
('Panel Real Plaza','Prol.Cesar Vallejo cuadra 13 - REAL PLAZA','Paradero','1024px X 384px',0),
('Panel El Porvenir','Av.Pumacahua Cdra 13 - EL PORVENIR','Paradero','1024px X 384px',0);
