<?php
require 'connect.php'; // Aquí defines $mysqli
session_start();

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = $usuario['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $mensaje = 'Credenciales incorrectas.';
        }

        $stmt->close();
    } else {
        $mensaje = 'Por favor completa todos los campos.';
    }
}
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
            <div><a href="home.php" class="nav-titulo">GRANJA POKEMON</a></div>

            
        </div>
    </header>

    <div class="form-session" id="login">
        <form method="POST" action="login.php">
            <h2>iniciar sesión</h2>
            <label>Email:</label>
            <input type="username" name="username" required><br><br>
            <label>Contraseña:</label>
            <input type="password" name="password" required><br><br>
            <button type="submit">login</button>
            <p>¿no tienes cuenta? <a href="register.php">registrate</a></p>
        </form>
    </div>
</body>

</html>
