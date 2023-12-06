<?php include './include/header.php' ;
include("traitement.php") ;

$idth=$_GET['id'];
session_start();

$idUser=$_SESSION['idUtl'];


if (isset($_POST["save_data"])) {
  $name = $_POST['namarticle'];
  $desc = mysqli_real_escape_string($conn, $_POST['description_a']);
  date_default_timezone_set("Africa/Casablanca");
  $date = date("Y-m-d H:i:s");

  $i_name = $_FILES['image']['name'];
  $i_tmp = $_FILES['image']['tmp_name'];

  $si_extension = pathinfo($i_name, PATHINFO_EXTENSION);
  $i_lower = strtolower($si_extension);
  $arrytype = array("jpg", "jpeg", "png");

  if (in_array($i_lower, $arrytype)) {
      $new_image = uniqid("IMG-", true) . '.' . $i_lower;
      $upload_path = './img/' . $new_image;
      move_uploaded_file($i_tmp, $upload_path);

      // Gérer les tags
      $tags = isset($_POST['tag']) ? implode(',', $_POST['tag']) : '';

      $qery = "INSERT INTO articles( nomAr, descriptionAr, imageAr, dateAr, idUtl, idTh, tagsAr)
               VALUES ('$name', '$desc', '$upload_path', '$date', '$idUser', '$idth', '$tags')";
      $result = mysqli_query($conn, $qery);

      if ($result) {

          echo "Insertion réussie.";
          echo "<script>alert('Article cree avec succès.')</script>";
          echo "<script>setTimeout(function(){ window.location.href = 'blog.php'; }, 1000);</script>";
      } else {

          echo "Erreur de creation : " . mysqli_error($conn);
      }
  } 
}


?>




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
        width: 40vw;
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
    .btnTags{
      border-radius: 7px;
      height: 40px;
      width: 100px;
      background-color: #132a137e;
      color: white;
    }


</style>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
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
    <!-------------------------------------------------------------- section de popup ----------------------------------------------------------->
  <section class="popupArticle">
  <div class="modal fade"  id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="insertdataLabel">INSERT ARTICLE</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <div class="from-group mb-3">
          <label for="" class="mb-2 fs-4">Name Article</label>
          <input type="text" name="namarticle" class=" form-control" placeholder="name">
        </div>
        <div class="from-group mb-3">
          <label for="" class="mb-2 fs-4">Description</label>
          <input type="text" name="description_a" class=" form-control" placeholder="description">
        </div>
        <div class="from-group mb-3">
          <label for="" class="mb-2 fs-4">Image</label>
          <input type="file" name="image" class=" form-control" placeholder="image">
        </div>
        <div class="from-group mb-3">
          <label for="" class="mb-2 fs-4">Tags</label>
          <p>Selectionnez un tag</p>
          
          <?php
            $req="SELECT nomTag
            FROM tags tg
            JOIN tags_theme tgh ON tg.idTag = tgh.idTag
            JOIN themes th ON th.idTh = tgh.idTh
            WHERE th.idTh = $idth";

            $result= $conn->query($req);
            while ($row=$result->fetch_assoc()) {
              echo '<input type="checkbox" value="'.$row['nomTag'].'" name="tag[]">';
              echo $row['nomTag'];
              echo "<br>";
              }
            
          ?>
        </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="save_data" class="btn btn-primary" value="Save Data"></input>
        </div>
        </form>
      </div>
    </div>
  </div>
  </section>
<!-- --------------------------------------------------fin-------------------------------------------------------- -->

<section class="w-100 " style="margin-top: 150px;" >
<div class="barre d-flex justify-content-center align-items-center gap-5">
  <!-- ------------tags------------------- -->
  <div class="tags d-flex gap-3">
          <?php
              $req="SELECT nomTag
              FROM tags tg
              JOIN tags_theme tgh ON tg.idTag = tgh.idTag
              JOIN themes th ON th.idTh = tgh.idTh
              WHERE th.idTh = $idth";

              $result= $conn->query($req);
              while ($row=$result->fetch_assoc()) {
                echo '<input type="button"  class="btnTags" value="'.$row['nomTag'].'" name="tag[]">';
                }           
            ?>
  </div>
  <!-- ------------add article --------------->
  <div class="" >
        <div class=" justify-content-center ">
            <div class="">
                <div class="">
                    <div >
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="26" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
    </svg>
                        </button>

                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w-100 row d-flex justify-content-center gap-5" style="margin-top:40px">
  <?php  
  $reqarticle="select * from articles where idTh=$idth ";
  $result=mysqli_query($conn,$reqarticle);
  while($row=mysqli_fetch_row($result)) {
   
  ?>
<div class="card mb-4 col- "style="width:25%">


  <div class=" mt-2 ">
    <img class="card-img-top " style="height: 20vw;" src="<?php echo $row[3]?>"

      alt="Card image cap">
  </div>


  <div class="card-body">


    <h4 class="card-title"><?php echo $row[1] ?></h4>
      <span class="mask rgba-white-slight text-success"><?php echo $row[4] ?></span>
    <p class="card-text" ><?php echo $row[2] ?></p>
    <button type="button" class="btn btn-light-blue btn-md">Read more</button>

  </div>

</div>

 

<?php 
  }
  ?>
  
</section>



<?php include './include/footer.php' ?>

</body>
</html>