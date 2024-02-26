<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <header>
            <h1>PROYECTO PHP</h1>
            <h3>Ana Maria y José Antonio</h3>
        </header>
        <nav>
            <a href="paginaInicial.php" <?php if (basename($_SERVER['PHP_SELF']) == 'paginaInicial.php') echo 'class="active"'; ?>> Pagina Inicial</a>
            <a href="funcionalidad2.php"> Funcion 2</a>
            <a href="funcionalidad3.php"> Funcion 3</a>
            <a href="funcionalidad4.php"> Funcion 4</a>
            <a href="funcionalidad5.php"> Funcion 5</a>
            <a href="funcionalidad6.php"> Funcion 6</a>
            <a href="funcionalidad7.php"> Funcion 7</a>
        </nav>
        <main>
            <div class="wrapper">
                <img src="https://lordicon.com/icons/wired/flat/1319-php-code-language.gif">
            </div>
        </main>
    </body>

</html>