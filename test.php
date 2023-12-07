<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection de champ</title>
</head>
<body>

<h2>Sélectionnez un champ :</h2>

<!-- Liste déroulante -->
<select id="champSelectionne" onchange="afficherChampSelectionne()">
    <option value="champ1">Champ 1</option>
    <option value="champ2">Champ 2</option>
    <option value="champ3">Champ 3</option>
</select>

<!-- Affichage du champ sélectionné -->
<p id="affichageChamp"></p>

<script>
function afficherChampSelectionne() {
    // Récupérer la valeur sélectionnée de la liste déroulante
    var champSelectionne = document.getElementById("champSelectionne").value;

    // Afficher la valeur sélectionnée
    document.getElementById("affichageChamp").innerText = "Champ sélectionné : " + champSelectionne;
}
</script>

</body>
</html>