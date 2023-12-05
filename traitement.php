<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "opep2";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

?>