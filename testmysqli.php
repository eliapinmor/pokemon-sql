<?php
$mysqli = new mysqli("localhost", "root", "", "dam");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$mysqli->query("INSERT INTO users (email, password) VALUES (" . $_POST['email'] . ", " . $_POST['password'] . ")");

// Print auto-generated id
echo "New record has id: " . $mysqli->insert_id;

$mysqli->close();
