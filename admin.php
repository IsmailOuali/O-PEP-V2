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
        echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
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
            echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
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
        echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
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
        echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
    } else {
        echo "<script>alert('Erreur lors de la modification de la catégorie. Veuillez réessayer.')</script>";
    }
}



//ajouter theme
// Ajouter un thème
if (isset($_POST['submitTheme'])) {
    $nomTheme = $_POST['nomTheme'];
    $descriptionTheme = $_POST['descriptionTheme'];
    $imageTheme = $_POST['imageTheme'];

    if (is_array($_POST['tags'])) {
        $tags = implode(',', $_POST['tags']);
    } else {
        $tags = $_POST['tags'];
    }

    $insertThemeQuery = "INSERT INTO themes (nomTh, descriptionTh, imageTh) VALUES ('$nomTheme', '$descriptionTheme', '$imageTheme')";
    $result = $conn->query($insertThemeQuery);

    $idTheme = $conn->insert_id;
    $tagsArray = explode(',', $tags);
    foreach ($tagsArray as $tag) {
        $tag = trim($tag);
        $insertTagQuery = "INSERT INTO tags (nomTag) VALUES ('$tag')";
        $conn->query($insertTagQuery);
        $idTag = $conn->insert_id;
        $insertLinkQuery = "INSERT INTO tags_theme (idTh, idTag) VALUES ('$idTheme', '$idTag')";
        $result2 = $conn->query($insertLinkQuery);
    }

    if ($result2 && $result) {
        echo "<script>alert('Le thème a été ajouté avec succès.')</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
    } else {
        echo "<script>alert('Erreur lors de l'ajout du thème : " . $conn->error . "')</script>";
    }
}



//suprimer theme
if (isset($_POST['submitSuppressiontheme'])) {
    $idTheme = $_POST['idthemeSuppression'];

$deleteTagsThemeQuery = "DELETE FROM tags_theme WHERE idTh = '$idTheme'";
$conn->query($deleteTagsThemeQuery);

$deleteThemeQuery = "DELETE FROM themes WHERE idTh = '$idTheme'";
$result = $conn->query($deleteThemeQuery);

if ($result != false) {
    
    echo "<script>alert('Le thème a été supprimé avec succès.')</script>";
    echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
    
} else {
    echo "<script>alert('Erreur lors de la suppression du thème. Veuillez réessayer.')</script>";
}
}



// supprimer Article
if (isset($_POST['submitSuppressionArticle'])) {

     $idArticle = $_POST['idArticleSuppression'];
    echo "<script>alert('ID de l'article à supprimer : " . $idArticle . "')</script>";

    $deleteArticleQuery = "DELETE FROM articles WHERE idAr = '$idArticle'";
    $result = $conn->query($deleteArticleQuery);

    if ($result) {
        echo "<script>alert('L'article a été supprimé avec succès.')</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 1000);</script>";
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
    <style>
        .main--countainer{
            padding: 2em;
            margin: 2em 100em;
            display: flex;
            height: 100vh;

        }

        .info-countainer{
            justify-content: center;
            align-items: center;

            }

        .infos{
            padding: 1em;
            width: 70%;
            text-align: center;
            font-size: 1.6em;
        }
        .infos .count{
            color: green;
        }

    </style>
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
                <li>
                    <a href="#">
                        <div class="sidebar--item" onclick="afficherFormulaireModificationTheme()">Modifier Theme</div>
                    </a>
                </li>
            </ul>
            <!-- <ul class="sidebar--bottom--items">
                <li>
                    <a href="connection.php">
                        <span class="icon"><i class="ri-logout-box-r-line"></i></span>
                        <div class="sidebar--item">Logout</div>
                    </a>
                </li>
            </ul> -->
        </div>
        <div class="main--container">
            <div class="form-container" id="formContainer">
                <!-- Ici, le formulaire apparaîtra après le clic sur "Ajouter Plante" -->
                <?php
                    $reqcth= "SELECT COUNT(*) FROM themes";
                    $sent = mysqli_query($conn, $reqcth);

                    $rowcth = mysqli_fetch_row($sent);

                    $reqctag= "SELECT COUNT(*) FROM tags";
                    $senttag = mysqli_query($conn, $reqctag);

                    $rowctag = mysqli_fetch_row($senttag);

                    $reqcar= "SELECT COUNT(*) FROM articles";
                    $sentar = mysqli_query($conn, $reqcar);

                    $rowcar = mysqli_fetch_row($sentar);


                    $reqccl= "SELECT COUNT(nomRole) FROM roles WHERE nomRole = 'client'";
                    $sentcl = mysqli_query($conn, $reqccl);

                    $rowccl = mysqli_fetch_row($sentcl);

                    $reqcad= "SELECT COUNT(nomRole) FROM roles WHERE nomRole = 'admin'";
                    $sentad = mysqli_query($conn, $reqcad);

                    $rowcad = mysqli_fetch_row($sentad);
                    ?>
        <div class="countainer">

            <div class="info-countainer">
                            
                <div class="infos">
                    <p class="titre-count">Nombres de themes:</p>
                    <p class="count"><?php echo $rowcth[0] ?></p>
                </div>
                
                <div class="infos">
                    <p class="titre-count">Nombres de tags:</p>
                    <p class="count"><?php echo $rowctag[0] ?></p>
                </div>
                
                <div class="infos">
                    <p class="titre-count">Nombres de articles:</p>
                    <p class="count"><?php echo $rowcar[0] ?></p>
                </div>
                <div class="infos">
                    <p class="titre-count">Nombres de clients:</p>
                    <p class="count"><?php echo $rowccl[0] ?></p>
                </div>
                <div class="infos">
                    <p class="titre-count">Nombres de admin:</p>
                    <p class="count"><?php echo $rowcad[0] ?></p>
                </div>
            </div>
        </div>
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

// ----------------------------------------------FormulaireModiferTheme------------------------------------
function afficherFormulaireModificationTheme() {
        var formContainer = document.getElementById("formContainer");
        formContainer.innerHTML = `
            <div class="close-button" onclick="fermerFormulaireModificationTheme()">X</div>
            <h2>Modifier Theme</h2>
            <form method="POST" onsubmit="submitModificationTheme()">
                <label for="idThemeModification">Sélectionnez le Theme à modifier :</label>
                <select id="champSelectionne" name="idThemeModification" class="form-control" required onchange="afficherChampSelectionne()">
                    <?php
                    // Récupérer les catégories depuis la base de données
                    $ThemesQuery = $conn->query("SELECT * FROM themes");

                    while ($Theme = $ThemesQuery->fetch_assoc()) {
                        echo "<option value='{$Theme['idTh']}'>{$Theme['nomTh']}</option>";
                    }
                    ?>
                </select><br>
                <label for="nouveauNomTheme">Nouveau nom de Theme :</label>
                <input type="text" id="nouveauNomTheme" name="nouveauNomTheme" class="form-control" required><br>
                <label for="nouveauDescriptionTheme">Nouveau Description de Theme :</label>
                <input type="text" id="nouveauDescriptionTheme" name="nouveauDescriptionTheme" class="form-control" required><br>
                <label for="nouveauImageTheme">Nouveau Image de Theme :</label>
                <input type="text" id="nouveauImageTheme" name="nouveauImageTheme" class="form-control" required><br>
                <h3>Tags</h3>
                <p id="affichageChamp"></p>
                <button type="submit" name="submitModificationTheme">Modifier</button>
            </form>
        `;
    }

    function afficherChampSelectionne() {
        // Récupérer la valeur sélectionnée de la liste déroulante
        var champSelectionne = document.getElementById("champSelectionne").value;

        // Afficher la valeur sélectionnée
        document.getElementById("affichageChamp").innerText = "Champ sélectionné : " + champSelectionne;
        
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

// ----------------------------------------------FormulaireSupprimerTheme------------------------------------

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

function fermerFormulaireModificationTheme() {
        var formContainer = document.getElementById("formContainer");
        formContainer.innerHTML = "";
    }

</script>

<!-- ... Votre code JavaScript existant ... -->

</body>

</html>
