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
                echo "Connected $this->bdname <br>";
            } catch (PDOException $e) {
                echo "Connection failed2: " . $e->getMessage();
            }
            return $conn;
        }

        public function importarJson($archivo)
        {
            //importamos la base de datos 
            $videojuegos = array();
            $jsonString = file_get_contents($archivo);
            $videojuegos = json_decode($jsonString, true, 512, JSON_INVALID_UTF8_SUBSTITUTE);
            if (json_last_error() !== JSON_ERROR_NONE) {
                die('Error  JSON: ' . json_last_error_msg());
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
                        echo "El desarollador esta repetido <br>";
                    } else {
                        $conn->exec("INSERT INTO desenvolupador(nombre) VALUES ('$nombre')");
                        $Desen_id = $conn->lastInsertId();
                        echo "El desarollador se ha insertado <br>";
                    }

                    // //Inserir Plataforma
                    $nombre = $juego['Plataforma'];
                    $nombres = explode(', ', $nombre);

                    //Inserir Videojuego
                    $nombre = $juego['Nom'];
                    $lanzamiento = $juego['Llançament'];
                    $nombreModificado = str_replace("'", "´", $nombre);
                    $resultado = $conn->query("SELECT * FROM videojuego WHERE nombre = '$nombreModificado'");
                    if ($resultado->rowCount() > 0) {
                        echo "Los videojuego estan repetidos <br>";
                        $Vid_id = $row['id'];
                    } else {
                        $conn->exec("INSERT INTO videojuego(nombre, fecha_lanzamiento, pegi, id_desenvolupador) VALUES ('$nombreModificado', '$lanzamiento', 9, $Desen_id)");
                        $Vid_id = $conn->lastInsertId();
                        echo "Los videojuego estan insertaos <br>";
                    }

                    // Inserir videojuego-plataforma
                    foreach ($nombres as $plataforma) {
                        // Buscar la plataforma en la base de datos
                        $resultado = $conn->query("SELECT * FROM plataforma WHERE nombre = '$plataforma'");

                        if ($resultado->rowCount() > 0) {
                            // La plataforma ya existe, obtener su ID
                            $row = $resultado->fetch(PDO::FETCH_ASSOC);
                            $Plata_id = $row['id'];
                            echo "La plataforma $plataforma ya existe con ID $Plata_id <br>";
                        } else {
                            // La plataforma no existe, insertarla
                            $conn->exec("INSERT INTO plataforma(nombre) VALUES ('$plataforma')");
                            $Plata_id = $conn->lastInsertId();
                            echo "La plataforma $plataforma se ha insertado con ID $Plata_id <br>";
                        }

                        $resultado2 = $conn->query("SELECT * FROM video_plata WHERE id_videojuego = '$Vid_id' and id_plataforma = '$Plata_id'");
                        if ($resultado2->rowCount() > 0) {
                            $row = $resultado2->fetch(PDO::FETCH_ASSOC);
                            $VidPlata_id = $row['id'];
                            echo "La plataforma $plataforma ya existe con ID $VidPlata_id <br>";
                        } else {
                            $conn->exec("INSERT INTO video_plata(id_videojuego, id_plataforma) VALUES ('$Vid_id', '$Plata_id')");
                            $VidPlata_id = $conn->lastInsertId();
                            echo "La plataforma $plataforma se ha insertado con ID $VidPlata_id <br>";
                        }
                    }
                }

                $conn = null;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
    $bbdd = new BBDD("db", "root", "politecnic", "Juegos");
    $conn = $bbdd->connectar_bd();
    $conn = $bbdd->importarJson("games.json");
    ?>
</body>

</html>