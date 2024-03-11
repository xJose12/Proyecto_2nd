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
    <title>Funcionalidad 2</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include 'clase.php';
    ?>
    <header>
        <h1>Insertar JSON</h1>
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
        <a href="funcionalidad2.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad2.php') echo 'class="active"'; ?>> Funcion 2</a>
        <a href="funcionalidad3.php"> Funcion 3</a>
        <a href="funcionalidad4.php"> Funcion 4</a>
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad6.php"> Funcion 7</a>
    </nav>

    <main>
        <?php
        $import = $bbdd->importarJson("games.json");
        if ($import) {
            echo "<h2>¡Tus videojuegos se han importado correctamente!</h2>";
            echo '<img src="https://media.tenor.com/WsmiS-hUZkEAAAAj/verify.gif" alt="Foto importación correcta">';
        } else {
            echo "<h2>¡Se ha producido un error durante la importación!</h2>";
            echo "<h3>Revisa si tu archivo json es correcto.</h3>";
            echo '<img src="https://images.emojiterra.com/google/noto-emoji/unicode-15/animated/274c.gif" alt="Foto importación mal">';
        };
        ?>

    </main>

</body>

</html>