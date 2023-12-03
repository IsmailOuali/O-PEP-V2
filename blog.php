<?php include("traitement.php"); 

session_start();
$userId = $_SESSION['idUtl'];
$reqet="SELECT * FROM panier JOIN plantes ON panier.idPlante = plantes.idPlante WHERE idUtl= $userId";
$result2 = $conn->query($reqet);
$count = mysqli_num_rows($result2);

if (isset($_POST['addToCart'])) {
    
    $plantId = $_POST['addToCart'];

    $insertQuery = "INSERT INTO panier (idUtl, idPlante, quantite) VALUES ('$userId','$plantId',1)";
    $result = $conn->query($insertQuery);
   
    if ($result) {
        // rje3 l page li 9bel
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "<script>alert('erreur d'ajout')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styleBlog.css">
    <title>Document</title>
</head>
<style>
        body {
        /* background-color: #132A13; */
        /* color: aliceblue;
        margin-top: 2rem; */
    }

    .sec1 h1 {
        font-size: 3.5vw;
        width: 24vw;
        color: black;
    }

    .sec1 p {
        font-size: 1.2vw;
        margin-top: 2rem;
        color: black;
    }

    .sec1 button {
        color: white;
        background-color: transparent;
        border: 2px solid white;
        width: 10vw;
        margin-top: 2rem;
    }

    .sec3 .card {
        height: 26vw;
        margin-bottom: 1.5rem;
        color: black; 
        max-width: 19.5rem;
        background-color: white;
        text-align: center;
        padding: 10px;
        border-radius: 20px;
    }

    .card-img-custom {
        width: 40%;
        height: 10vw;
        object-fit: cover;
        border-radius: 8px;
    }

    .card-body {
        height: 100%;
    }

    .card-text {
        margin-bottom: 1rem; 
        color: #4F772D; 
        text-align: left;
    }

    .card-title {
        color: #4F772D;
        text-align: left; 
    }

    .pagination {
        justify-content: center;


    }
    .count{
        color: white;
        padding: 0px 6px;
        background-color: red;
        border-radius: 40px;
    }
    .panier{
        position: fixed;
        right: 40px;
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
                      <li >
                    <a href="panier.php" class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        <p class=" count"><?php echo $count ?></p>
                    </a> 
                      </li>
                    </ul>  

                    <!-- <div class="logo" style="height: 40px;display: flex;justify-content: space-between; padding:40px ; margin-top:0px; color:black"></div> -->

                    </div>   
            </nav>
    </header>    
  <hr color="black" size="1" style=" margin-top: 100px">
    <section class="sec1 d-flex" style="width: 100%;">
  
        <div class="division1" style="width: 42%">
            <img src="plantes/jardin.jpg" style="height: 45vw; width:40vw; padding:24px " alt="img">
        </div>
        <div class="division2" style="width: 58%; padding:24px ">
            <div >
                <h1>Le Jardin</h1>
                <p>Qu’il soit exigu, suspendu ou à perte de vue, qu’il soit le prolongement d’une maison ou qu’il
                    tienne sur un coin de balcon, le jardin, c’est l’endroit des possibles. Que vous soyez novice
                    ou confirmé, exigeant ou conciliant, nos spécialistes vous dévoilent tous leurs secrets et vous
                    accompagnent pas à pas pour faire de votre jardin, votre nouvel eden. Notre sélection d’articles 
                    vous donnera toute la matière nécessaire pour en savoir plus sur l’univers du jardinage et la 
                    décoration de votre joli cocon. Nos conseils et astuces vous apporteront, quant à eux, toutes les 
                    préconisations spécifiques adaptées à chaque variété de plantes (arrosage, rempotage, exposition…). 
                    Nous vous avons préparé tout ce qu’il faut pour que vous osiez jardiner 
                    (sur un coin de balcon ou au bout de la maison) sans plus aucune appréhension... Eh oui, il n’a jamais
                    été aussi facile d’avoir la main verte !
                </p>
            </div>
            <div class="division12" style=" margin-top:40px">
            <a href="#" style="text-decoration: none;">
                <table>
                <tr>
                    <td style=" border: 1px solid black;  padding: 10px; width:35vw ; gap:50px"  class="d-flex" >
                        <img src="plantes/jardin2.jpg" style="height: 10vw;width:10vw" alt="img">
                        <div class="d-flex flex-column">
                            <h3 style="color: black;">Tout sur...les variétés</h3>
                            <div class="d-flex" style=" align-items: center; gap:10px">
                                <a href="#" style="color: black; " style="text-decoration: none;">En savoir plus</a>
                                <svg width="14" height="12" viewBox="0 0 14 12" xmlns="http://www.w3.org/2000/svg">
                                <path d="M-4.97198e-07 6.77851L11.0896 6.77851L7.06538 10.8992L8.14044 12L14 6L8.14044
                                4.41415e-07L7.06538 1.10082L11.0896 5.22149L-3.61078e-07 5.22149L-4.97198e-07 6.77851Z">
                                </path>
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                </table>    
                

                </a>
            </div>
                 
        </div>
    </section>
    <hr color="black" size="1" >
    
    <section class="sec2"></section>
    <section class="sec3"></section>
</body>

</html>
