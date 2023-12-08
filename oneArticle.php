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
 
     /* nav */ 
        nav{
            
            z-index: 1000;
            height: 50px;
        }
        .nav__logo img {
            width: 120px;
            padding-top: 10px;
        }
        .search {
            position: relative;
            width: 26%;
            left: 22%;
        }
        .nav__menu{
            position: absolute;
            right:10rem;
    }

        .nav__list{
        padding-top: 25px;
        list-style: none;
        display: flex;
        gap: 3rem;
        align-items: center;
       
        }
        .nav__list a{
            color: white;
            cursor: pointer;
        }
        .nav__list a :hover{
            color: green;
            
        }
        .nav__list .nav__item a :hover{
            color: green;
        }
        .button--flex {
        display: inline-flex;
        align-items: center;
        column-gap: 0.5rem;
}

        .navbar__button {
            position: absolute;
            background-color: red;
            border-radius: 0.35rem;
            font-size: 1.25rem;
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
<header style=" background-color: #132a137e; height:80px; width:100%; position:absolute;  top:0;">
        <nav class="nav container">
                <a href="#" class="nav__logo">
                    <img src="plantes/logo.png" alt="logo">
                </a> 
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li >
                            <a href="client.php"  style="font-size: 20px ; ">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="blog.php"  style="font-size: 20px;">Blog</a>
                        </li>
                        <!-- shopping cart -->
                        <li>
                          <a href="panier.php" style="cursor: pointer;">
                            <i class="ri-shopping-bag-line" style="font-size:27px;"></i>
                        </a>
                      </li>
                         <!-- log out -->
                        <li>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                          <a href="connection.php">
                          <i class="ri-logout-box-r-line" style="font-size:27px;"></i>
                        </a>
                        </form>
                      </li>

                    </ul>  

                  

                    </div>   
            </nav>
    </header>
<div class="bg-white flex justify-center">
    <div class="mt-10 mx-8" style="width: 50%;">
        <img style="width: 100%;" src="<?php echo $article['imageAr']; ?>" alt="<?php echo $article['nomAr']; ?>" class="">
    </div>
    <div class="w-1/2 flex flex-col justify-center items-start">
        <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $article['nomAr']; ?></h1>
        <p class="text-base text-gray-600 text-left"><?php echo $article['descriptionAr']; ?></p>
    </div>
</div>
  

            </div>
       

</body>
</body>
</html>