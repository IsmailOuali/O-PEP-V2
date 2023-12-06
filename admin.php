<?php

require_once "traitement.php";

// Ajout de Plante
if (isset($_POST['submitPlante'])) {

    $nomPlante = $_POST['nomPlante'];
    $imagePlante = $_POST['imagePlante'];
    $descriptionPlante = $_POST['descriptionPlante'];
    $stockPlante = $_POST['stockPlante'];
    $prix = $_POST['prix'];
    $idCategorie = $_POST['idCategorie']; 

    $query ="INSERT INTO plantes (nomPlante, imagePlante, descriptionPlante, stock, prix, idCategorie) VALUES ('$nomPlante','$imagePlante' ,'$descriptionPlante','$stockPlante','$prix','$idCategorie')";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Plante ajoutée avec succès.')</script>";
    } else {
        echo "<script>alert('Erreur lors de l'ajout de la plante. Veuillez réessayer.')</script>";
    }
}




// Ajout de catégorie
if (isset($_POST['submitCategorie'])) {
    
    $nomCategorie = $_POST['nomCategorie'];
   
    $query = "INSERT INTO categories (nomCategorie) VALUES ('$nomCategorie')";
    $result = $conn->query($query);
 

        if ($result) {
            echo "<script>alert('Catégorie ajoutée avec succès.')</script>";
        } else {
            echo "<script>alert('Erreur lors de l'ajout de la catégorie. Veuillez réessayer.')</script>";
        }

}


// Suppression de plante
if (isset($_POST['submitSuppressionPlante'])) {
    $idPlanteSuppression = $_POST['idPlanteSuppression'];
    
    // Supprimer les enregistrements liés dans details_commande
    $queryDetails = "DELETE FROM details_commande WHERE idPlante = '$idPlanteSuppression'";
    $resultDetails = $conn->query($queryDetails);

    // Supprimer la plante dans plantes
    $queryPlante = "DELETE FROM plantes WHERE idPlante = '$idPlanteSuppression'";
    $resultPlante = $conn->query($queryPlante);

    if ($resultPlante) {
        echo "<script>alert('Plante supprimée avec succès.')</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de la plante. Veuillez réessayer.')</script>";
    }
}


// Modification de catégorie
if (isset($_POST['submitModificationCategorie'])) {
    
    $idCategorieModification = $_POST['idCategorieModification'];
    $nouveauNomCategorie = $_POST['nouveauNomCategorie'];

    $query = "UPDATE categories SET nomCategorie = '$nouveauNomCategorie' WHERE idCategorie = '$idCategorieModification'";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Catégorie modifiée avec succès.')</script>";
    } else {
        echo "<script>alert('Erreur lors de la modification de la catégorie. Veuillez réessayer.')</script>";
    }
}



//ajouter theme
if(isset($_POST['submitTheme'])){

    $nomTheme = $_POST['nomTheme'];
    $descriptionTheme = $_POST['descriptionTheme'];
    $imageTheme = $_POST['imageTheme'];
    
    if (is_array($_POST['tags'])) {
        $tags = implode(',', $_POST['tags']);
    } else {
        $tags = $_POST['tags'];
    }

    $insertThemeQuery = "INSERT INTO themes (nomTh, descriptionTh, imageTh) VALUES ('$nomTheme', '$descriptionTheme', '$imageTheme')";
    $conn->query($insertThemeQuery);

    $idTheme = $conn->insert_id;
    $tagsArray = explode(',', $tags);
    foreach ($tagsArray as $tag) {
        $tag = trim($tag);
        $insertTagQuery = "INSERT INTO tags (nomTag) VALUES ('$tag')";
        $conn->query($insertTagQuery);
        $idTag = $conn->insert_id;
        $insertLinkQuery = "INSERT INTO tags_theme (idTh, idTag) VALUES ('$idTheme', '$idTag')";
        $conn->query($insertLinkQuery);
    }
}


//suprimer theme
if (isset($_POST['submitSuppressiontheme'])) {
    $idTheme = $_POST['idthemeSuppression'];

$deleteTagsThemeQuery = "DELETE FROM tags_theme WHERE idTh = '$idTheme'";
$conn->query($deleteTagsThemeQuery);

$deleteThemeQuery = "DELETE FROM themes WHERE idTh = '$idTheme'";
$result = $conn->query($deleteThemeQuery);

if ($result) {
    echo "<script>alert('Le thème a été supprimé avec succès.')</script>";
} else {
    echo "<script>alert('Erreur lors de la suppression du thème. Veuillez réessayer.')</script>";
}
}



// supprimer Article
if (isset($_POST['submitSuppressionArticle'])) {
    // echo "<script>alert('hey')</script>";
     $idArticle = $_POST['idArticleSuppression'];
    echo "<script>alert('ID de l'article à supprimer : " . $idArticle . "')</script>";

    $deleteArticleQuery = "DELETE FROM articles WHERE idAr = '$idArticle'";
    $result = $conn->query($deleteArticleQuery);

    if ($result) {
        echo "<script>alert('L'article a été supprimé avec succès.')</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de l'article : " . $conn->error . "')</script>";
    }
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAdmin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>OPEP</title>
</head>
<body class="body">
    <section class="header">
        <h1><span style="color: #567255;">O</span>P<span style="color: #567255;">E</span>P</h1>
    </section>
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#"  onclick="afficherFormulaireAjoutCategorie()">
                        <div class="sidebar--item">Ajouter Catégorie</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="afficherFormulaireModificationCategorie()">Modifier Catégorie</div>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="afficherFormulaireAjoutPlante()">
                        <div class="sidebar--item">Ajouter Plante</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="afficherFormulaireSuppressionPlante()">Supprimer Plante</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="afficherFormulaireAjoutTheme()">Ajouter Theme</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="supprimerFormulaireTheme()">Supprimer Theme</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="afficherFormulaireSuppressionArticle()">Supprimer Article</div>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom--items">
                <li>
                    <a href="connection.php">
                        <span class="icon"><i class="ri-logout-box-r-line"></i></span>
                        <div class="sidebar--item">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main--container">
            <div class="form-container" id="formContainer">
                <!-- Ici, le formulaire apparaîtra après le clic sur "Ajouter Plante" -->
            </div>
        </div>
    </section>

    <!-- ... Votre code JavaScript existant ... -->

<script>
    // ----------------------------------------------FormulaireAjoutPlante------------------------------------
    function afficherFormulaireAjoutPlante() {
        var formContainer = document.getElementById("formContainer");
        formContainer.innerHTML = `
            <div class="close-button" onclick="fermerFormulaireAjoutPlante()">X</div>
            <h2>Ajouter Plante</h2>
            <form method="POST"  >

                <label for="idCategorie">Catégorie :</label>
                <select id="idCategorie" name="idCategorie" required>
                    <?php
                    // Récupérer les catégories depuis la base de données
                    $categoriesQuery = $conn->query("SELECT * FROM categories");

                    while ($categorie = $categoriesQuery->fetch_assoc()) {
                        echo "<option value='{$categorie['idCategorie']}'>{$categorie['nomCategorie']}</option>";
                    }
                    ?>
                </select><br>
                <label for="nomPlante">Nom de la Plante:</label>
                <input type="text" id="nomPlante" name="nomPlante" required><br>
                <label for="imagePlante">Image de la Plante (URL):</label>
                <input type="file" id="imagePlante" name="imagePlante" required><br>

                <label for="descriptionPlante">Description:</label>
                <textarea id="descriptionPlante" name="descriptionPlante" required></textarea><br>

                <label for="stockPlante">Stock:</label>
                <input type="number" id="stockPlante" name="stockPlante" required><br>

                <label for="prixFr">Prix (en Francs CFA):</label>
                <input type="number" id="prixFr" name="prix" required><br>

                <!-- ... Ajoutez d'autres champs si nécessaire ... -->

                <button type="submit" name="submitPlante">Ajouter</button>
            </form>
        `;
    }

  // ----------------------------------------------FormulaireAjoutCategorie------------------------------------
    function afficherFormulaireAjoutCategorie() {
        var formContainer = document.getElementById("formContainer");
        formContainer.innerHTML = `
            <div class="close-button" onclick="fermerFormulaireAjoutCategorie()">X</div>
            <h2>Ajouter Catégorie</h2>
            <form method="POST">
                <label for="nomCategorie">Nom de la Catégorie:</label>
                <input type="text" id="nomCategorie" name="nomCategorie" required><br>
                <button type="submit" name="submitCategorie">Ajouter</button>
            </form>
        `;
    }

// ----------------------------------------------FormulaireSupprimerPlante------------------------------------
    function afficherFormulaireSuppressionPlante() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = `
        <div class="close-button" onclick="fermerFormulaireSuppressionPlante()">X</div>
        <h2>Supprimer Plante</h2>
        <form method="POST">
            <label for="idPlanteSuppression">Sélectionnez la plante à supprimer :</label>
            <select id="idPlanteSuppression" name="idPlanteSuppression" class="form-control" required>
                <?php

                $plantesQuery = $conn->query("SELECT * FROM plantes");

                while ($plante = $plantesQuery->fetch_assoc()) {
                    echo "<option value='{$plante['idPlante']}'>{$plante['nomPlante']}</option>";
                }
                ?>
            </select><br>
            <button id="bttn" type="submit" name="submitSuppressionPlante">Supprimer</button>
        </form>
    `;
}
// ----------------------------------------------FormulaireSupprimerArticle------------------------------------
function afficherFormulaireSuppressionArticle() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = `
        <div class="close-button" onclick="fermerFormulaireSuppressionArticle()">X</div>
        <h2>Supprimer Article</h2>
        <form method="POST">
            <label for="idArticleSuppression">Sélectionnez la article à supprimer :</label>
            <select id="idArticleSuppression" name="idArticleSuppression" class="form-control" required>
                <?php

                $articlesQuery = $conn->query("SELECT * FROM articles");

                while ($article = $articlesQuery->fetch_assoc()) {
                    echo "<option value='{$article['idAr']}'>{$article['nomAr']}</option>";
                }
                ?>
            </select><br>
            <button id="bttn" type="submit" name="submitSuppressionArticle">Supprimer</button>
        </form>
    `;
}

// ----------------------------------------------FormulaireModiferCategorie------------------------------------
function afficherFormulaireModificationCategorie() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = `
        <div class="close-button" onclick="fermerFormulaireModificationCategorie()">X</div>
        <h2>Modifier Catégorie</h2>
        <form method="POST">
            <label for="idCategorieModification">Sélectionnez la catégorie à modifier :</label>
            <select id="idCategorieModification" name="idCategorieModification" class="form-control" required>
                <?php
                // Récupérer les catégories depuis la base de données
                $categoriesQuery = $conn->query("SELECT * FROM categories");

                while ($categorie = $categoriesQuery->fetch_assoc()) {
                    echo "<option value='{$categorie['idCategorie']}'>{$categorie['nomCategorie']}</option>";
                }
                ?>
            </select><br>
            <label for="nouveauNomCategorie">Nouveau nom de la catégorie :</label>
            <input type="text" id="nouveauNomCategorie" name="nouveauNomCategorie" class="form-control" required><br>
            <button type="submit" name="submitModificationCategorie">Modifier</button>
        </form>
    `;
}
    // ----------------------------------------------FormulaireAjoutTheme------------------------------------
    function afficherFormulaireAjoutTheme() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = `
        <div class="close-button" onclick="fermerFormulaireAjoutTheme()">X</div>
        <h2>Ajouter Theme</h2>
        <form method="POST" onsubmit="ajouterTheme(); return false;">
            <label for="nomTheme">Nom de Theme:</label>
            <input type="text" id="nomTheme" name="nomTheme"><br>
            <label for="descriptionTheme">Description de Theme:</label>
            <input type="text" id="DescriptionTheme" name="descriptionTheme"><br>
            <label for="imageTheme">Image de Theme:</label>
            <input type="file" id="imageTheme" name="imageTheme"><br>
            <label for="tags">Tags (séparés par des virgules):</label>
            <input type="text" id="tags" name="tags"><br>
            <button type="submit" name="submitTheme">Ajouter</button>
        </form>
    `;
}

// ----------------------------------------------FormulaireSuprimerTheme------------------------------------

function supprimerFormulaireTheme(){
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = `
    <div class="close-button" onclick="fermerFormulaireSupprimerFormulaireTheme()">X</div>
        <h2>Supprimer Theme</h2>
        <form method="POST">
            <label for="idthemeSuppression">Sélectionnez leTheme à supprimer :</label>
            <select id="idthemeSuppression" name="idthemeSuppression" class="form-control" required>
                <?php

                $themesQuery = $conn->query("SELECT * FROM themes");

                while ($theme = $themesQuery->fetch_assoc()) {
                    echo "<option value='{$theme['idTh']}'>{$theme['nomTh']}</option>";
                }
                ?>
            </select><br>
            <button id="bttn" type="submit" name="submitSuppressiontheme">Supprimer</button>
        </form>
        `;
}
//****************************************************************************************************************** */

function fermerFormulaireModificationCategorie() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = "";
}


function fermerFormulaireSuppressionPlante() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = "";
}


function fermerFormulaireAjoutPlante() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = ""; 
}


function fermerFormulaireAjoutCategorie() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = ""; 
}

function fermerFormulaireSupprimerFormulaireTheme() {
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = ""; 
}

</script>

<!-- ... Votre code JavaScript existant ... -->

</body>

</html>
