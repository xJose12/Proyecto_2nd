<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <a href="paginaloggin.php" class="login-button">Iniciar Sesión</a>
        <h1>PROYECTO PHP</h1>
        <h3>Ana Maria y José Antonio</h3>
    </header>
    <nav>
        <a href="paginaInicial.php" <?php if (basename($_SERVER['PHP_SELF']) == 'paginaInicial.php') echo 'class="active"'; ?>> Pagina Inicial</a>
        <?php if (isset($_SESSION['user'])) {echo '<a href="funcionalidad2.php"> Funcion 2</a>';}?>
        <?php if (isset($_SESSION['user'])) {echo '<a href="funcionalidad3.php"> Funcion 3</a>';}?>
        <a href="paginas/funcionalidad4.php"> Funcion 4</a>
        <?php if (isset($_SESSION['user'])) {echo '<a href="funcionalidad5.php"> Funcion 5</a>';}?>
        <a href="paginas/funcionalidad6.php"> Funcion 6</a>
        <?php if (isset($_SESSION['user'])) {echo '<a href="funcionalidad7.php"> Funcion 7</a>';}?>
    </nav>
    <main>
        <div class="wrapper">
            <img src="https://lordicon.com/icons/wired/flat/1319-php-code-language.gif">
        </div>
    </main>
</body>

</html>
