<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 4</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de Consultas y Eliminación</h1>
    </header>

    <nav>
        <a href="paginaInicial.php"> Pagina Inicio</a>
        <a href="funcionalidad2.php"> Funcion 2</a>
        <a href="funcionalidad3.php"> Funcion 3</a>
        <a href="funcionalidad4.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad4.php') echo 'class="active"'; ?>> Funcion 4</a>
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad7.php"> Funcion 7</a>
    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <label for="consulta">Consultas</label><br>
            <select name="consulta" id="consulta">
                <option value="">Selecciona Tu Consulta</option>
                <option value="genero">Genero</option>
                <option value="desenvolupador">Desenvolupador</option>
                <option value="plataforma">Plataforma</option>
            </select>
            <input type="submit" value="Consultar">
        </form> <br>

        <?php
        $consulta = $consultaEliminar = $eliminar = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && (test_input($_GET["consulta"]) != null or test_input($_GET["eliminar"]) != null)) {
            $consulta = test_input($_GET["consulta"]);
            $consultaEliminar = test_input($_GET["consulta"]);
            $eliminar = test_input($_GET["eliminar"]);

            $bbdd = new BBDD("db", "root", "politecnic", "Juegos");
            $consulta = $bbdd->consultar($consulta);
            if ($consulta != null) {
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

                if ($consultaEliminar == "genero" || $consultaEliminar == "desenvolupador" || $consultaEliminar == "plataforma") {
                    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="get">';
                    echo '<label for="eliminar">Eliminar ';

                    if ($consultaEliminar == "genero") {
                        echo 'Genero';
                    } elseif ($consultaEliminar == "desenvolupador") {
                        echo 'Desenvolupador';
                    } elseif ($consultaEliminar == "plataforma") {
                        echo 'Plataforma';
                    }

                    echo '</label><br>';
                    echo '<select name="eliminar" id="eliminar">';
                    // Agregar la opción por defecto
                    echo '<option value="" selected>Selecciona tu ';

                    if ($consultaEliminar == "genero") {
                        echo 'genero';
                    } elseif ($consultaEliminar == "desenvolupador") {
                        echo 'desenvolupador';
                    } elseif ($consultaEliminar == "plataforma") {
                        echo 'plataforma';
                    }

                    echo '</option>';
                    foreach ($resultado as $row) {
                        echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="submit" value="Eliminar">';
                    echo '</form>';
                }
                echo "<br>";

                if (!empty($resultado)) {
                    echo "<table border=1px>";
                    echo "<tr>\n";
                    foreach ($resultado[0] as $key => $useless) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>\n";
                    foreach ($resultado as $row) {
                        echo "<tr>\n";
                        foreach ($row as $key => $val) {
                            echo "<td>$val</td>";
                        }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";
                }
            } else {
                echo "No existen datos dentro de la tabla.";
            }
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

    </main>
</body>

</html>