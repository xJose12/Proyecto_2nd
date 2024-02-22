<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 3</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de insercción </h1>
    </header>

    <nav>
        <a href="paginaInicial.html"> Pagina Inicio</a>
        <a href="funcionalidad3.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad3.php') echo 'class="active"'; ?>> Funcion 3</a>
        <a href="funcionalidad4.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad4.php') echo 'class="active"'; ?>> Funcion 4</a>
        <a href="funcionalidad5.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad5.php') echo 'class="active"'; ?>> Funcion 5</a>
        <a href="funcionalidad6.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad6.php') echo 'class="active"'; ?>> Funcion 6</a>
        <a href="funcionalidad7.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad7.php') echo 'class="active"'; ?>> Funcion 7</a>
    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <h2>Inserir Genero</h2>
            Nombre: <input type="text" name="GeneroNombre"><br>
            <h2>Inserir Desenvolupador</h2>
            Nombre: <input type="text" name="DesenvolupadorNombre"><br>
            <h2>Inserir Plataforma</h2>
            Nombre: <input type="text" name="PlataformaNombre"><br><br>
            <input type="submit">
         </form> <br>

         <?php
        $GeneroNombre = $DesenvolupadorNombre = $PlataformaNombre = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["GeneroNombre"] != null) 
        or test_input($_GET["PlataformaNombre"] != null) or test_input($_GET["DesenvolupadorNombre"] != null)) {
            $GeneroNombre = test_input($_GET["GeneroNombre"]);
            $DesenvolupadorNombre = test_input($_GET["DesenvolupadorNombre"]);
            $PlataformaNombre = test_input($_GET["PlataformaNombre"]);
           
            echo "<h2>Insercciones</h2>";
            echo "Genero Nombre: $GeneroNombre <br>";
            echo "Desenvolupador Nombre: $DesenvolupadorNombre <br>";
            echo "Plataforma Nombre: $PlataformaNombre <br>";

            $inserir = new BBDD("db", "root", "politecnic", "Juegos");
            $insertar = $inserir->alta($GeneroNombre, $DesenvolupadorNombre, $PlataformaNombre);
            

        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

    </main>
</body>

</html>