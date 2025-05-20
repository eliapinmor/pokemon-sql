<?php
session_start();

// VERIFICACIÓN DE SESIÓN
if (!isset($_SESSION["usuario"])) {
    // Si no hay sesión, redirige al login
    header("Location: login.php");
    exit;
}

// Si ha iniciado sesión, continúa mostrando el dashboard
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icon.png" type="image/x-icon">


</head>

<body>
    <header style="background-color: #FFD700; height: 150px;display: flex;flex-direction: column;gap: 15px;">
        <div>
            <h1 style="margin: 0;">GRANJA POKEMON</h1>
        </div>
    </header>
    <div style="display: flex; width: 70%; margin: auto; min-height: 70vh; gap: 25x; flex-direction: column;">
        <div class="form" style="margin: auto; margin-top: 100px;display: flex; flex-direction: row; gap:45px">
            <form>
                <div>
                    <label>Nombre del pokemon</label>
                    <input class="name">
                    <button>🔍</button>
                </div>
                <div>

                </div>
            </form>
            <p class="container"></p>
        </div>

        <div class="showPokeContainer">
            <div style="margin: auto;">
                <p>REGISTROS DE POKEMON</p>
                <div style="display: flex; align-self: center;">
                    <img src="img/filter.png" style="width: 35px;">
                    <select id="filterType">
                        <option value="todos">Todos</option>
                        <option value="fire">Fuego</option>
                        <option value="water">Agua</option>
                        <option value="grass">Planta</option>
                        <option value="electric">Eléctrico</option>
                        <option value="psychic">Psíquico</option>
                        <option value="ice">Hielo</option>
                        <option value="dragon">Dragón</option>
                        <option value="dark">Siniestro</option>
                        <option value="fairy">Hada</option>
                        <option value="normal">Normal</option>
                        <option value="fighting">Lucha</option>
                        <option value="flying">Volador</option>
                        <option value="poison">Veneno</option>
                        <option value="ground">Tierra</option>
                        <option value="rock">Roca</option>
                        <option value="bug">Bicho</option>
                        <option value="ghost">Fantasma</option>
                        <option value="steel">Acero</option>
                    </select>
                </div>
            </div>
            <div class="showPoke">

            </div>
        </div>
    </div>

    <footer style="background-color: #FFD700; height: 100px; margin-top: 50px;">
        <p>Elia Pineda Moreno © - Granja Pokemon 2025</p>
    </footer>
</body>

</html>