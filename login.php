<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $archivo = "users.json";

    if (file_exists($archivo)) {
        $usuarios = json_decode(file_get_contents($archivo), true);
        foreach ($usuarios as $usuario) {
            if ($usuario["email"] === $email && $usuario["password"] === $password) {
                $_SESSION["usuario"] = $email;
                $_SESSION["rol"] = "admin";
                $_SESSION["fecha"] = date("Y-m-d H:i:s");
                $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
                header("Location: dashboard.php");
                exit;
            }
        }
    }
    echo "<p>Email o contraseña incorrectos.</p>";



}


    // echo "testeando= ". print_r($_SESSION,true);
?>
<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css?v=173">


</head>


<body>
        <header style="background-color: #FFD700; height: 150px;display: flex;flex-direction: column;gap: 15px;">
        <div style="display: flex; justify-content: space-around; width: 70%;align-items: center;">
            <div><h1 style="margin: 0;">GRANJA POKEMON</h1></div>
            <div style="display: flex; flex-direction:row; gap: 25px;">
                <div><a href="#login" class="nav-button">iniciar sesión</a></div>
                <div><a href="register.php" class="nav-button">registrarse</a></div>
            </div>
            
        </div>
    </header>

    <div class="form-session" id="login">
        <form method="POST" action="login.php">
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
            <label>Contraseña:</label>
            <input type="password" name="password" required><br><br>
            <button type="submit">login</button>
            <p>¿no tienes cuenta? <a href="register.php">registrate</a></p>
        </form>
    </div>
</body>

</html>