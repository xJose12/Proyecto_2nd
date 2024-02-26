<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 4</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Formulario de Consultas y Eliminación</h1>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <label for="consulta">Consultas</label>
            <select name="consulta" id="consulta">
                <option value="genero">Genero</option>
                <option value="desenvolupador">Desenvolupador</option>
                <option value="plataforma">Plataforma</option>
            </select>
            <input type="submit" value="Consultar">

            <h2>Eliminar Genero(ID)</h2>
            ID: <input type="number" name="GeneroNombre"><br>
            <h2>Eliminar Desenvolupador(ID)</h2>
            ID: <input type="number" name="DesenvolupadorNombre"><br>
            <h2>Eliminar Plataforma(ID)</h2>
            ID: <input type="number" name="PlataformaNombre"><br><br>
            <input type="submit">
        </form> <br>

        <?php
        $consulta = $eliminar = "";

        if (
            $_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["consulta"] != null)
            or test_input($_GET["eliminar"] != null)
        ) {
            $consulta = test_input($_GET["consulta"]);
            $eliminar = test_input($_GET["eliminar"]);

            $bbdd = new BBDD("db", "root", "politecnic", "Juegos");
            $consulta = $bbdd->consultar($consulta);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado != null) {
                echo "<table border=1px wdith=\"100%\">\n";
                echo "<tr>\n";
                foreach ($resultado[0] as $key => $useless) {
                    echo "<th>$key</th>";
                }
                echo "</tr>\n";
                foreach ($resultado as $row) {
                    echo "<tr>\n";
                    foreach ($row as $key => $val) {
                        echo "<td>$val</td>";
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
            } else {
                print("No hay valores en la tabla $consulta");
            }
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

    </main>
</body>

</html>