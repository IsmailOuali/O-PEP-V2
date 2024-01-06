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
 
        /* Add your existing styles here */

        /* Additional styles for navbar */
        /* nav */
        nav {
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

        .nav__menu {
            position: absolute;
            right: 10rem;
        }

        .nav__list {
            padding-top: 25px;
            list-style: none;
            display: flex;
            gap: 3rem;
            align-items: center;
        }

        .nav__list a {
            color: white;
            cursor: pointer;
        }

        .nav__list a:hover {
            color: green;
        }

        .nav__list .nav__item a:hover {
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
        /* Footer Styles */
        section {
      flex: 1;
    }

    footer {
      background-color: #132a137e;
    }
     

    
    </style>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <title>articl</title>
    </head>
   


<body>
 <!-- Navbar -->
 <header style=" background-color: #132a137e; height:80px; width:100%; position:relative;  top:0;">
        <nav class="nav container" >
                <a href="client.php" class="nav__logo">
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

                         <!-- log out -->
                        <li>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                          <a href="connection.php">
                          <i class="ri-logout-box-r-line" style="font-size:27px;"></i>
                        </a>
                        </form>
                      </li>
                      <li >
                    <a href="panier.php" class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>

                    </a> 
                      </li>
                    </ul>

                    </div>   
            </nav>
    </header>
    <!-- End Navbar -->
            <div class="bg-white flex justify-center">
                <div class="mt-10 mx-8 mb-36" style="width: 50%;">
                    <img style="width: 100%;" src="<?php echo $article['imageAr']; ?>" alt="<?php echo $article['nomAr']; ?>" class="">
                </div>
                <div class="w-1/2 flex flex-col justify-center items-start">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $article['nomAr']; ?></h1>
                    <p class="text-base text-gray-600 text-left"><?php echo $article['descriptionAr']; ?></p>
                </div>
            </div>
            

            </div>
       
            

</body>
</html>
<?php include './include/footer.php' ?>