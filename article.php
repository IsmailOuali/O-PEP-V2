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
      width: auto;
      background-color: #132a137e;
      color: white;
    }
    .imogies{
      cursor: pointer;
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
   $_SESSION['idAr']=$row[0];
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
    <div class="imogi_Read d-flex justify-content-between align-items-center">

      <div class="imogi d-flex gap-4">
            <!-- commentaire -->
            <svg class="imogies" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894m-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
            </svg>
            <!-- like -->
            <svg class="imogies"  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
            <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
            </svg>
      </div>
      <div class="read d-flex justify-content-center align-items-center">
        <button type="submit" name="read_more" id="read" class="btn btn-light-blue btn-md">Read more</button>
        <svg xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
      </div>

    </div>
  </div>

</div>

 

<?php 
  }
  ?>
  
</section>



<?php include './include/footer.php' ?>

</body>
</html>