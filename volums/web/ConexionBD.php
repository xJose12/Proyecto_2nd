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
                $conn = $this->connectar_bd();

                foreach ($videojuegos as $desarrollo) {
                    $nombre = $desarrollo['Desenvolupador'];

                    $resultado = $conn->query("SELECT * FROM desenvolupador WHERE nombre = '$nombre'");
                    if ($resultado->rowCount() > 0) {
                        echo "El desarollador $nombre esta repetido <br>";
                    } else {
                        $conn->exec("INSERT INTO desenvolupador (nombre) VALUES ('$nombre')");
                    }
                }
                $conn = null;
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