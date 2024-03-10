<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class BBDD
    {
        private $servername;
        private $usuario;
        private $contraseña;
        private $bdname;

        public function __construct($servername, $usuario, $contraseña, $bdname)
        {
            $this->servername = $servername;
            $this->usuario = $usuario;
            $this->contraseña = $contraseña;
            $this->bdname = $bdname;
        }

        public function connectar_bd()
        {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->bdname;", $this->usuario, $this->contraseña);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed2: " . $e->getMessage();
            }
            return $conn;
        }

        public function importarJson($archivo)
        {
            //importamos el json
            $videojuegos = array();
            if (!file_exists($archivo)) {
                return false;
            }
            $jsonString = file_get_contents($archivo);
            $videojuegos = json_decode($jsonString, true, 512, JSON_INVALID_UTF8_SUBSTITUTE);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }

            //Inserir datos
            try {
                $conn = $this->connectar_bd();

                foreach ($videojuegos as $juego) {
                    //Inserir Deselvolupador
                    $nombre = $juego['Desenvolupador'];

                    $resultado = $conn->query("SELECT * FROM desenvolupador WHERE nombre = '$nombre'");
                    if ($resultado->rowCount() > 0) {
                        $row = $resultado->fetch(PDO::FETCH_ASSOC);
                        $Desen_id  = $row['id'];
                    } else {
                        $conn->exec("INSERT INTO desenvolupador(nombre) VALUES ('$nombre')");
                        $Desen_id = $conn->lastInsertId();
                    }

                    //Inserir Videojuego
                    $nombre = $juego['Nom'];
                    $lanzamiento = $juego['Llançament'];
                    $nombreModificado = str_replace("'", "´", $nombre);
                    $resultado = $conn->query("SELECT * FROM videojuego WHERE nombre = '$nombreModificado'");
                    if ($resultado->rowCount() > 0) {
                        $Vid_id = $row['id'];
                    } else {
                        $conn->exec("INSERT INTO videojuego(nombre, fecha_lanzamiento, pegi, id_desenvolupador) VALUES ('$nombreModificado', '$lanzamiento', 9, $Desen_id)");
                        $Vid_id = $conn->lastInsertId();
                    }

                    // Inserir plataforma // videojuego-plataforma
                    $nombre = $juego['Plataforma'];
                    $nombres = explode(', ', $nombre);

                    foreach ($nombres as $plataforma) {
                        // Buscar la plataforma en la base de datos
                        $resultado = $conn->query("SELECT * FROM plataforma WHERE nombre = '$plataforma'");

                        if ($resultado->rowCount() > 0) {
                            // La plataforma ya existe, obtener su ID
                            $row = $resultado->fetch(PDO::FETCH_ASSOC);
                            $Plata_id = $row['id'];
                        } else {
                            // La plataforma no existe, insertarla
                            $conn->exec("INSERT INTO plataforma(nombre) VALUES ('$plataforma')");
                            $Plata_id = $conn->lastInsertId();
                        }

                        $resultado2 = $conn->query("SELECT * FROM video_plata WHERE id_videojuego = '$Vid_id' and id_plataforma = '$Plata_id'");
                        if ($resultado2->rowCount() > 0) {
                            $row = $resultado2->fetch(PDO::FETCH_ASSOC);
                            $VidPlata_id = $row['id'];
                        } else {
                            $conn->exec("INSERT INTO video_plata(id_videojuego, id_plataforma) VALUES ('$Vid_id', '$Plata_id')");
                            $VidPlata_id = $conn->lastInsertId();
                        }
                    }
                }

                $conn = null;
                return true;
            } catch (PDOException $e) {
                // echo "Connection failed: " . $e->getMessage();
                return false;
            }
        }

        public function alta($GeneroNombre, $DesenvolupadorNombre, $PlataformaNombre)
        {
            $conn = $this->connectar_bd();
            //Insertar desenvolupadores
            if ($DesenvolupadorNombre != null) {
                try {
                    $resultado = $conn->query("SELECT * FROM desenvolupador WHERE nombre = '$DesenvolupadorNombre'");

                    if ($resultado->rowCount() == 0) {
                        $conn->exec("INSERT INTO desenvolupador(nombre) VALUES ('$DesenvolupadorNombre')");
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
            //Insertar plataforma
            if ($PlataformaNombre != null) {
                try {
                    $resultado = $conn->query("SELECT * FROM plataforma WHERE nombre = '$PlataformaNombre'");

                    if ($resultado->rowCount() == 0) {
                        $conn->exec("INSERT INTO plataforma(nombre) VALUES ('$PlataformaNombre')");
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
            //Insertar genero
            if ($GeneroNombre != null) {
                try {
                    $resultado = $conn->query("SELECT * FROM genero WHERE nombre = '$GeneroNombre'");

                    if ($resultado->rowCount() == 0) {
                        $conn->exec("INSERT INTO genero(nombre) VALUES ('$GeneroNombre')");
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
        }

        // Consultar tablas
        public function consultar($tablaConsulta)
        {
            $conn = $this->connectar_bd();
            try {
                $resultado = $conn->prepare("SELECT * FROM $tablaConsulta");
                $smtp = $resultado->execute();
                if ($resultado->rowCount() == 0) {
                    $resultado = null;
                    return ($resultado);
                } else {
                    return ($resultado);
                }
                $conn = null;
            } catch (PDOException $e) {
                //throw $th;
            }
        }

        public function eliminar($tabla, $nombre)
        {
            $conn = $this->connectar_bd();
            try {
                $resultado = $conn->query("SELECT * FROM $tabla WHERE nombre = '$nombre'");

                if ($resultado->rowCount() > 0) {
                    $row = $resultado->fetch(PDO::FETCH_ASSOC);
                    $idtabla = $row['id'];

                    if ($tabla == "genero") {
                        $conn->exec("DELETE FROM video_gen WHERE id_genero = '$idtabla'");
                        $conn->exec("DELETE FROM genero WHERE id = '$idtabla'");
                    } else if ($tabla == "desenvolupador") {
                        $conn->exec("UPDATE videojuego SET id_desenvolupador = NULL WHERE id_desenvolupador = $idtabla");
                        $conn->exec("DELETE FROM $tabla where nombre = '$nombre'");
                    } else if ($tabla == "plataforma") {
                        $conn->exec("DELETE FROM video_plata WHERE id_plataforma = '$idtabla'");
                        $conn->exec("DELETE FROM plataforma WHERE id = '$idtabla'");
                    }
                }
                return $nombre;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }


        public function eliminarVideojuego($videojuegoNombre)
        {
            $conn = $this->connectar_bd();
            try {
                $resultado = $conn->query("SELECT * FROM videojuego WHERE nombre = '$videojuegoNombre'");
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
                $idVideojuego = $row['id'];

                $conn->exec("DELETE FROM video_gen WHERE id_videojuego = '$idVideojuego'");
                $conn->exec("DELETE FROM video_plata WHERE id_videojuego = '$idVideojuego'");
                $conn->exec("DELETE FROM videojuego WHERE id = '$idVideojuego'");
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function consultarVideo_Nom_Fecha_Empresa($consulta, $tipoConsulta)
        {
            $conn = $this->connectar_bd();
            try {
                if ($tipoConsulta == 'nombre') {
                    $resultado = $conn->query("SELECT * FROM videojuego WHERE nombre LIKE '%$consulta%'");
                } elseif ($tipoConsulta == 'fecha') {
                    $resultado = $conn->query("SELECT * FROM videojuego WHERE fecha_lanzamiento = '$consulta'");
                } elseif ($tipoConsulta == 'empresa') {
                    $resultado = $conn->query("SELECT videojuego.*, desenvolupador.nombre AS Nombre_Empresa
                                               FROM videojuego 
                                               JOIN desenvolupador ON videojuego.id_desenvolupador = desenvolupador.id 
                                               WHERE desenvolupador.nombre LIKE '%$consulta%'");
                }
                if ($resultado->rowCount() == 0) {
                    return null;
                } else {
                    return $resultado;
                }
                $conn = null;
            } catch (PDOException $e) {
                //throw $th;
            }
        }

        public function insertarVideojuego() {
            $conn = $this->connectar_bd();
        } 
    }

    ?>
</body>

</html>