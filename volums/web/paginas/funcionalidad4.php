<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 4</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de Consultas y Eliminación</h1>
        <?php

        if (!isset($_SESSION['user'])) {
            echo '<a href="../paginaloggin.php" class="login-button">Iniciar Sesión</a>';
        } else {
            echo '<a href="../cerrarsesion.php" class="login-button">Cerrar Sesión</a>';
        }

        ?>
    </header>

    <nav>
        <a href="../paginaInicial.php"> Pagina Inicio</a>
        <?php if (isset($_SESSION['user'])) {
            echo '<a href="funcionalidad2.php"> Funcion 2</a>';
        } ?>
        <?php if (isset($_SESSION['user'])) {
            echo '<a href="funcionalidad3.php"> Funcion 3</a>';
        } ?>
        <a href="funcionalidad4.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad4.php') echo 'class="active"'; ?>> Funcion 4</a>
        <?php if (isset($_SESSION['user'])) {
            echo '<a href="funcionalidad5.php"> Funcion 5</a>';
        } ?>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <?php if (isset($_SESSION['user'])) {
            echo '<a href="funcionalidad7.php"> Funcion 7</a>';
        } ?>
    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <h2>Consultas</h2>
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

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["consulta"])) {
            $consulta = test_input($_GET["consulta"]);
            $resultado = $bbdd->consultar($consulta);

            if ($resultado !== null) {
                $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($resultado) && isset($_SESSION['user'])) {
                    // Formulario de eliminación
                    echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="get">';
                    echo '<h2>Eliminar ';

                    if ($consulta == "genero") {
                        echo 'Genero';
                    } elseif ($consulta == "desenvolupador") {
                        echo 'Desenvolupador';
                    } elseif ($consulta == "plataforma") {
                        echo 'Plataforma';
                    }

                    echo '</h2>';
                    echo '<select name="eliminar" id="eliminar">';
                    echo '<option value="" selected>Selecciona el elemento a eliminar</option>';
                    foreach ($resultado as $row) {
                        echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="hidden" name="consultaEliminar" value="' . $consulta . '">';
                    echo '<input type="submit" value="Eliminar">';
                    echo '</form>';
                    echo "<table>";
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
                } elseif (!empty($resultado)) {
                    echo "<table>";
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
                } else {
                    echo "No existen datos dentro de la tabla.";
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
            $eliminar = test_input($_GET["eliminar"]);
            $consultaEliminar = test_input($_GET["consultaEliminar"]);
            $eliminar = $bbdd->eliminar($consultaEliminar, $eliminar);
            if (isset($eliminar)) {
                echo "Se ha eliminado $eliminar";
            } else {
                echo "No se ha eliminado nada";
            }
        }
        ?>

    </main>
</body>

</html>