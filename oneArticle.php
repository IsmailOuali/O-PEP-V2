<?php

session_start();
$idAr= $_SESSION['idAr'];
require_once "traitement.php";

// Vérifie si l'identifiant de l'article est présent dans l'URL
if(isset($_GET['id'])) {
    $idArticle = $_GET['id'];

    // Récupère les détails de l'article en fonction de son identifiant
    $query = "SELECT * FROM articles WHERE idAr = $idArticle";
    $result = mysqli_query($conn, $query);

    // Vérifie si la requête a réussi
    if($result) {
        $article = mysqli_fetch_assoc($result);
    } else {
        echo "Erreur de récupération des données de l'article : " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Identifiant de l'article non spécifié.";
    exit();
}
?>
<style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .article {
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
        }

        .image-container {
            flex: 1;
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 8px 0 0 8px;
        }

        .article-content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        /* Ajoutez d'autres styles en fonction de vos besoins */
  </style>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <title>articl</title>
    </head>
    <body>
      <h1></h1>
    </body>
  </html></style>
</head>
<body>
<body>
    <div class="container">
        <div class="article bg-white rounded shadow-md overflow-hidden flex w-full">
            <div class="image-container flex-shrink-0 ">
                <img src="<?php echo $article['imageAr']; ?>" alt="<?php echo $article['nomAr']; ?>" class="w-full h-auto rounded-l">
            </div>
            <div class="article-content flex-1 p-4">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2"><?php echo $article['nomAr']; ?></h1>
                <p class="text-base text-gray-600"><?php echo $article['descriptionAr']; ?></p>
            </div>
        </div>
    </div>
</body>
</body>
</html>