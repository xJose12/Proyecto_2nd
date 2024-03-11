<?php
$servername = "db";
$username = "root";
$password = "politecnic";
$database = "Juegos";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la connexió
if ($conn->connect_error) {
    die("Error de connexión amb la base de dades: " . $conn->connect_error);
}

session_start();

// Verificar si l'usuari ja ha iniciat sessió, si es així, redirigir a "dashboard.php"
if (isset($_SESSION['user'])) {
    header("Location: paginaInicial.php");
    exit();
}

// Verificar si s'han enviat les daes per formulari
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenir dades del formulari
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Consultar la BBDD per verificar credencials
    $query = "SELECT * FROM usuarios WHERE user='$user' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Iniciar sessión i redirigir al dashboard
        $_SESSION['user'] = $user;
        header("Location: paginaInicial.php");
        exit();
    } else {
        $error_message = "Usuari o contrassenya incorrectes";
    }
}

// Tancar la connexió a la BBDD
$conn->close();
?>

<html lang="en">

<head>
    <?php
    include "paginas/ConexionBD.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style-loggin.css">
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="user-box">
                <input type="text" name="user" required>
                <label>Usuari</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Contrassenya</label>
            </div>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="Enviar">
            </a>

        </form>
        <?php
        // Mostrar mensaje de error si existe
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>
    </div>
</body>

</html>