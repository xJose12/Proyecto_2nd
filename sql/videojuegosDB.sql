-- Borrar la base de datos
DROP DATABASE IF EXISTS Juegos;

-- Crear la base de datos
CREATE DATABASE Juegos;

-- Usar la base de datos
USE Juegos;

-- Crear la tabla desenvolupador
CREATE TABLE desenvolupador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
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
    nombre VARCHAR(150) NOT NULL,
    fecha_lanzamiento DATE,
    pegi INT,
    id_desenvolupador INT,
    FOREIGN KEY (id_desenvolupador) REFERENCES desenvolupador(id)
);

CREATE TABLE video_gen (
	id_videojuego INT,
    id_genero INT,
	FOREIGN KEY (id_videojuego) REFERENCES videojuego(id),
    FOREIGN KEY (id_genero) REFERENCES genero(id)
);

CREATE TABLE video_plata (
	id_videojuego INT,
    id_plataforma INT,
	FOREIGN KEY (id_videojuego) REFERENCES videojuego(id),
    FOREIGN KEY (id_plataforma) REFERENCES plataforma(id)
);
