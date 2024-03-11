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
    <title>Funcionalidad 3</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de insercción </h1>
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
        <a href="funcionalidad3.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad3.php') echo 'class="active"'; ?>> Funcion 3</a>
        <a href="funcionalidad4.php"> Funcion 4</a>
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad7.php"> Funcion 7</a>
    </nav>

    <main>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <h2>Insertar Genero</h2>
                Nombre: <input type="text" name="GeneroNombre"><br>
                <h2>Insertar Desenvolupador</h2>
                Nombre: <input type="text" name="DesenvolupadorNombre"><br>
                <h2>Insertar Plataforma</h2>
                Nombre: <input type="text" name="PlataformaNombre"><br><br>
                <input type="submit">
            </form> <br>
        </div>


        <?php
        $GeneroNombre = $DesenvolupadorNombre = $PlataformaNombre = "";

        if (
            $_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["GeneroNombre"] != null)
            or test_input($_GET["PlataformaNombre"] != null) or test_input($_GET["DesenvolupadorNombre"] != null)
        ) {
            $GeneroNombre = test_input($_GET["GeneroNombre"]);
            $DesenvolupadorNombre = test_input($_GET["DesenvolupadorNombre"]);
            $PlataformaNombre = test_input($_GET["PlataformaNombre"]);

            echo "<h2>Insercciones</h2>";
            echo "Genero Nombre: $GeneroNombre <br>";
            echo "Desenvolupador Nombre: $DesenvolupadorNombre <br>";
            echo "Plataforma Nombre: $PlataformaNombre <br>";

            $insertar = $bbdd->alta($GeneroNombre, $DesenvolupadorNombre, $PlataformaNombre);
        }
        ?>
    </main>
</body>

</html>