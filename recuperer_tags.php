<?php
require_once "traitement.php";

if (isset($_POST['idTheme'])) {
    $idTheme = $_POST['idTheme'];

    // Récupérer les tags associés au thème
    $tagsQuery = $conn->query("SELECT t.nomTag FROM tags_theme tt JOIN tags t ON tt.idTag = t.idTag WHERE tt.idTh = '$idTheme'");

    while ($tag = $tagsQuery->fetch_assoc()) {
        echo "<span>{$tag['nomTag']}</span>";
    }
}
?>

