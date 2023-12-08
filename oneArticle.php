<?php

session_start();

require_once "traitement.php";
if(isset($_GET['id'])) {
    $idArticle = $_GET['id'];

    $query = "SELECT * FROM articles WHERE idAr = $idArticle";
    $result = mysqli_query($conn, $query);

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
          
            box-sizing: border-box;
        }
  img {
width: 300px;
height: 200px;

  }
     
       
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


        <div class=" bg-white flex justify-center  ">
            <div class="mt-10 mx-8" style="width: 50%;">
                <img style="width: auto;" src="<?php echo $article['imageAr']; ?>" alt="<?php echo $article['nomAr']; ?>" class="  ">
            </div>
            <div class=" flex flex-col  "style="width: 50%;">
                <h1 style="width: auto;" class="text-2xl font-semibold text-gray-800 "><?php echo $article['nomAr']; ?></h1>
                <p style="width: auto;" class="text-base text-gray-600 "><?php echo $article['descriptionAr']; ?></p>
            </div>
        </div>

</body>
</body>
</html>