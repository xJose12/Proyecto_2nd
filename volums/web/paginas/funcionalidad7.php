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
    <title>Funcionalidad 7</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de Eliminar Videojuego</h1>
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
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad7.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad7.php') echo 'class="active"'; ?>> Funcion 7</a>

    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <label for="consulta">Elige el videojuego:</label><br>
            <select name="eliminar" id="eliminar">
                <option value="">Selecciona tu videojuego</option>
                <?php
                $resultado = $bbdd->consultar('videojuego');
                foreach ($resultado as $row) {
                    echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Eliminar">
        </form> <br>

        <?php
        $eliminar = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
            $eliminar = test_input($_GET["eliminar"]);
            $consultaEliminar = test_input($_GET["consultaEliminar"]);
            $eliminar = $bbdd->eliminarVideojuego($eliminar);
            echo "Se ha eliminado $eliminar";
        }
        ?>
    </main>
</body>

</html>