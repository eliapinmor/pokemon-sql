<?php
require 'connect.php'; // Esto crea $mysqli

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Verificar si ya existe
        $check = $mysqli->prepare("SELECT id FROM usuarios WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $mensaje = "El usuario ya está registrado. <a href='login.php'>Inicia sesión</a>";
        } else {
            // Insertar nuevo usuario
            $stmt = $mysqli->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $passwordHash);

            if ($stmt->execute()) {
                $mensaje = "Usuario registrado correctamente. <a href='login.php'>Inicia sesión</a>";

            } else {
                $mensaje = "Error al crear el usuario.";
            }

            $stmt->close();
        }

        $check->close();
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

    <div class="form-session">
    <form method="POST">
            <h2>registrate</h2>

        <label>Email:</label>
        <input type="username" name="username" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Registrarse</button>
            <p style="font-size: 15px; color: #008000"><?php echo $mensaje; ?></p>

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
