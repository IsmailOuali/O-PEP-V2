<?php
require_once "traitement.php";

// Récupérer tous les thèmes avec leurs tags associés
$query = "SELECT t.*, GROUP_CONCAT(DISTINCT tg.nomTag ORDER BY tg.nomTag SEPARATOR ', ') AS tags
          FROM themes t
          LEFT JOIN tags_theme tt ON t.idTh = tt.idTh
          LEFT JOIN tags tg ON tt.idTag = tg.idTag
          GROUP BY t.idTh";
$result = $conn->query($query);

if ($result) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nom du Thème</th>
                <th>Description du Thème</th>
                <th>Image du Thème</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['idTh']}</td>
                <td>{$row['nomTh']}</td>
                <td>{$row['descriptionTh']}</td>
                <td>{$row['imageTh']}</td>
                <td>{$row['tags']}</td>
                <td>
                    <button onclick='afficherFormulaireModificationTheme({$row['idTh']})'>Modifier</button>
                    <button onclick='supprimerTheme({$row['idTh']})'>Supprimer</button>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Erreur lors de la récupération des thèmes.";
}
?>
