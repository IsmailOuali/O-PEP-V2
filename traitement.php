<?php
$servername = "localhost";
$username = "root";
$password = "167200216";
$database = "OPEP";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

?>