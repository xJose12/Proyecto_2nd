<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionalidad 6</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include "ConexionBD.php";
    ?>
    <header>
        <h1>Funcionalidad 6</h1>
    </header>

    <nav>
        <a href="paginaInicial.php"> Pagina Inicio</a>
        <a href="funcionalidad2.php"> Funcion 2</a>
        <a href="funcionalidad3.php"> Funcion 3</a>
        <a href="funcionalidad4.php"> Funcion 4</a>
        <a href="funcionalidad5.php"> Funcion 5</a>
        <a href="funcionalidad6.php" <?php if (basename($_SERVER['PHP_SELF']) == 'funcionalidad6.php') echo 'class="active"'; ?>> Funcion 6</a>
        <a href="funcionalidad7.php"> Funcion 7</a>

    </nav>

    <main>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <h2>Consultar por Nombre</h2>
                Nombre a Buscar: <input type="text" name="nombre">
                <input type="submit" value="Consultar">
                <h2>Consultar por Fecha</h2>
                Fecha a buscar: <input type="date" name="fecha">
                <input type="submit" value="Consultar">
                <h2>Consultar por Empresa</h2>
                <select name="empresa" id="empresa">
                    <option value="">Selecciona una Empresa</option>
                    <?php
                    $bbdd = new BBDD("db", "root", "politecnic", "Juegos");
                    $desenvolupador = $bbdd->consultar('desenvolupador');
                    foreach ($desenvolupador as $row) {
                        echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Consultar">
            </form>
        </div>

        <?php
        $nombre = $fecha = $empresa = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["nombre"] != null)) {
            $nombre = test_input($_GET["nombre"]);
            $resultado = $bbdd->consultarVideo_Nom_Fecha_Empresa($nombre, 'nombre');
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["fecha"] != null)) {
            $fecha = test_input($_GET["fecha"]);
            $resultado = $bbdd->consultarVideo_Nom_Fecha_Empresa($fecha, 'fecha');
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && test_input($_GET["empresa"] != null)) {
            $empresa = test_input($_GET["empresa"]);
            $resultado = $bbdd->consultarVideo_Nom_Fecha_Empresa($empresa, 'empresa');
        }
        if ($resultado !== null) {
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo "<table border=1px>";
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