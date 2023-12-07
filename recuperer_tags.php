<?php
require_once "traitement.php";

if (isset($_POST['idTheme'])) {
    $idTheme = $_POST['idTheme'];

    // Récupérer les tags associés au thème
    $query = "SELECT t.nomTag FROM tags_theme tt
              JOIN tags t ON tt.idTag = t.idTag
              WHERE tt.idTh = '$idTheme'";
    $result = $conn->query($query);

    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row['nomTag'];
    }

    // Afficher les tags sous forme de chaîne séparée par des virgules
    echo implode(', ', $tags);
}
?>
