<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 5</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Funcionalidad 5</h1>
    </header>

    <nav>
        <a href="paginaInicial.html"> Pagina Inicio</a>
        <a href="funcionalidad3.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad3.php') echo 'class="active"'; ?>> Funcion 3</a>
        <a href="funcionalidad4.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad4.php') echo 'class="active"'; ?>> Funcion 4</a>
        <a href="funcionalidad5.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad5.php') echo 'class="active"'; ?>> Funcion 5</a>
        <a href="funcionalidad6.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad6.php') echo 'class="active"'; ?>> Funcion 6</a>
        <a href="funcionalidad7.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad7.php') echo 'class="active"'; ?>> Funcion 7</a>
    </nav>

</body>

</html>