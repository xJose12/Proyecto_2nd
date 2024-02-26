<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 7</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Funcionalidad 7</h1>
    </header>

    <nav>
        <a href="paginaInicial.php"> Pagina Inicio</a>
        <a href="funcionalidad2.php"> Funcion 2</a>
        <a href="funcionalidad3.php"> Funcion 3</a>
        <a href="funcionalidad4.php"> Funcion 4</a>
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php"> Funcion 6</a>
        <a href="funcionalidad7.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad7.php') echo 'class="active"'; ?>> Funcion 7</a>

    </nav>

</body>

</html>