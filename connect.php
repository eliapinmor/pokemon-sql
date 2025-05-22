<?php
$mysqli = new mysqli("localhost", "root", "", "users_poke");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
