<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class BBDD {
        private $servername;
        private $usuario;
        private $contraseña;
        private $bdname;

        public function __construct($servername, $usuario, $contraseña, $bdname) {  
            $this->servername = $servername;
            $this->usuario = $usuario;
            $this->contraseña = $contraseña;
            $this->bdname = $bdname;
        }

        public function connectar_bd() {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->bdname", $this->usuario, $this->contraseña);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected $this->bdname <br>";
            } catch (PDOException $e) {
                echo "Connection failed2: " . $e->getMessage();
            }
            return $conn;
        }

        public function importarJson($archivo) {
            //importamos la base de datos 
            $videojuegos = array();
            $jsonString = file_get_contents($archivo);
            $videojuegos = json_decode($jsonString, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                die('Error  JSON: ' . json_last_error_msg());
            }
            //inserir el deselvolupador dentro de la tabla
            try {
                // $conn = $this->connectar_bd();
                // $nombres = array();
                // $repetidos = array();
                // $noRepetidos = array();

                // foreach ($videojuegos as $desarrollo) {
                //     $nombre = $desarrollo['Desenvolupador'];

                //     if (in_array($nombre, $nombres)) {
                //         $repetidos[] = $desarrollo;
                //     } else {
                //         $nombres[] = $nombre;
                //         $noRepetidos[] = $desarrollo;
                //         $sql
                //         $sql = "INSERT INTO desenvolupador (nombre) VALUES ('$desarrollo[Desenvolupador]')";
                //         echo "se han añadido los nuevos registros $desarrollo[Desenvolupador]";
                //         $conn->exec($sql);
                //         $last_id = $conn->lastInsertId();
                //     }
                    
                // }
                // $conn = null;
            } catch (PDOException $e) {
                echo "Connection failed: ". $e->getMessage();
            }
        }

    }
    $bbdd = new BBDD("db", "root", "politecnic", "Juegos");
    $conn = $bbdd->connectar_bd();
    $conn = $bbdd->importarJson("games.json");




    ?>
</body>
</html>