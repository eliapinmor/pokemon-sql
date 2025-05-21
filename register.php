<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $archivo = "users.json";

    if (file_exists($archivo)) {
        $usuarios = json_decode(file_get_contents($archivo), true);
    } else {
        $usuarios = [];
    }

    foreach ($usuarios as $usuario) {
        if ($usuario["email"] === $email) {
            echo "<p>Este correo ya está registrado.</p>";
            exit;
        }
    }

    $nuevoUsuario = ["email" => $email, "password" => $password];
    $usuarios[] = $nuevoUsuario;
    file_put_contents($archivo, json_encode($usuarios, JSON_PRETTY_PRINT));
    echo '<p>Usuario registrado correctamente. Ya puedes <a href="login.php">iniciar sesión</a>.</p>';


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

    <div class="form-session">
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Registrarse</button>
            <p>¿ya tienes una cuenta? <a href="login.php">inicia sesión</a></p>

    </form>
    </div>
</body>

<!-- <body>
    <h1>Registro de usuario</h1>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body> -->

</html>