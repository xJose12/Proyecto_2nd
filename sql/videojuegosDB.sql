-- Crear la base de datos
CREATE DATABASE Juegos;

-- Usar la base de datos
USE Juegos;

-- Crear la tabla desenvolupador
CREATE TABLE desenvolupador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

-- Crear la tabla plataforma
CREATE TABLE plataforma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

-- Crear la tabla genero
CREATE TABLE genero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

-- Crear la tabla videojuego con claves foráneas
CREATE TABLE videojuego (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    data_lanzamiento DATE,
    pegi INT,
    id_desenvolupador INT,
    id_plataforma INT,
    FOREIGN KEY (id_desenvolupador) REFERENCES desenvolupador(id),
    FOREIGN KEY (id_plataforma) REFERENCES plataforma(id)
);

CREATE TABLE video_gen (
	id_videojuego INT,
    id_genero INT,
	FOREIGN KEY (id_videojuego) REFERENCES videojuego(id),
    FOREIGN KEY (id_genero) REFERENCES genero(id)
);

