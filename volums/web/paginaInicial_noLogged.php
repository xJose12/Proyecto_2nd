<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginal Inicial</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <header>
            <h1>PROYECTO PHP</h1>
            <h3>Ana Maria y José Antonio</h3>
        </header>
        <nav>
            <a href="paginaInicial_noLogged.php" <?php if (basename($_SERVER['PHP_SELF']) == 'paginaInicial_noLogged.php') echo 'class="active"'; ?>> Pagina Inicial</a>
            <a href="paginas/funcionalidad4.php"> Funcion 4</a>
            <a href="paginas/funcionalidad6.php"> Funcion 6</a>
        </nav>
        <main>
            <div class="wrapper">
                <img src="https://lordicon.com/icons/wired/flat/1319-php-code-language.gif">
            </div>
        </main>
    </body>

</html>