<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../paginaInicial.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 5</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include "clase.php";
    ?>
    <header>
        <h1>Funcionalidad 5</h1>
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
        <a href="funcionalidad2.php"> Funcion 2</a>
        <a href="funcionalidad3.php"> Funcion 3</a>
        <a href="funcionalidad4.php"> Funcion 4</a>
        <a href="funcionalidad5.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad5.php') echo 'class="active"'; ?>> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad7.php"> Funcion 7</a>
    </nav>

    <main>

        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <h2>Inserta tu Videojuego</h2>
                Nombre: <input type="text" name="nombre" required><br>
                Fecha Lazamiento: <input type="date" name="fecha"><br>
                Pegi: <select name="pegi" id="pegi">
                    <option value="">Selecciona tu Pegi</option>
                    <option value=3>3</option>
                    <option value=7>7</option>
                    <option value=12>12</option>
                    <option value=16>16</option>
                    <option value=18>18</option>
                </select><br>
                <h4>Escoge tus Plataformas</h4>
                <div class="checkbox-container">
                    <?php
                    $resultado = $bbdd->consultar('plataforma');
                    if ($resultado) {
                        foreach ($resultado as $row) {
                            echo '<div class="checkbox-wrapper">';
                            echo '<input type="checkbox" name="plataforma[]" value="' . $row["nombre"] . '">';
                            echo '<label>' . $row["nombre"] . '</label>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No se encontraron plataforma';
                    }

                    ?>
                </div>
                Desarrollador:
                <select name="desarrollador" id="desarrollador">
                    <option value="">Selecciona tu Desarrollador</option>
                    <?php
                    $resultado = $bbdd->consultar('desenvolupador');
                    foreach ($resultado as $row) {
                        echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                    }
                    ?>
                </select><br>
                <h4>Escoge tus Generos</h4>
                <div class="checkbox-container">
                    <?php
                    $resultado = $bbdd->consultar('genero');
                    if ($resultado) {
                        foreach ($resultado as $row) {
                            echo '<div class="checkbox-wrapper">';
                            echo '<input type="checkbox" name="genero[]" value="' . $row["nombre"] . '">';
                            echo '<label>' . $row["nombre"] . '</label>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No se encontraron generos';
                    }

                    ?>
                </div>
                <input type="submit">
            </form> <br>
        </div>

        <?php
        $nombre = $fecha = $pegi = $plataformas = $desarrollador = $genero = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
            $nombre = test_input($_GET["nombre"]);
            $fecha = test_input($_GET["fecha"]);
            $pegi = test_input($_GET["pegi"]);
            $plataformas = $_GET["plataforma"];
            $desarrollador = test_input($_GET["desarrollador"]);
            $generos = $_GET["genero"];
            $insertar = $bbdd->insertarVideojuego($nombre, $fecha, $pegi, $plataformas, $desarrollador, $generos);
            echo "Se ha eliminado $eliminar";
        }
        ?>
    </main>
</body>

</html>