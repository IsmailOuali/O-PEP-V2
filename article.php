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

       
          echo "<script>alert('Article cree avec succès.')</script>";
          echo "<script>setTimeout(function(){ window.location.href = 'blog.php'; }, 1000);</script>";
      } else {

          echo "Erreur de creation : " . mysqli_error($conn);
      }
  } 
}

if(isset($_POST['cancel'])){
  header("Location: article.php?id=$idth");
}

if(isset($_POST['addComm'])){
  $commenter=$_POST['commente'];
  
  $idAr=$_POST['articleId'];
  
  
  // insertion du commentaire
  $req = "INSERT INTO commentaire (contenuCom, idUtl, idAr) VALUES 
        ('$commenter', '$idUser', '$idAr')";

  $result = mysqli_query($conn, $req);

  if ($result) {
      echo "<script>alert('commenter cree avec succès.')</script>";
      echo "<script>setTimeout(function(){ window.location.href = 'article.php?id=$idth'; }, 1000);</script>";
  } else {

      echo "Erreur de creation : " . mysqli_error($conn);
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
      border-radius: 10px;
      height: 40px;
      width: auto;
      background-color: transparent;
      color: black;
    }
    .imogies{
      cursor: pointer;
    }
    .modal-content{
      max-height: 80vh;
      overflow-y: scroll !important;
    }



</style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  
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
                        <!-- <li>
                          <a href="panier.php" style="cursor: pointer;">
                            <i class="ri-shopping-bag-line" style="font-size:27px;"></i>
                        </a>
                      </li> -->
                         <!-- log out -->
                        <li>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                          <a href="index.php">
                          <i class="ri-logout-box-r-line" style="font-size:27px;"></i>
                        </a>
                        </form>
                      </li>

                    </ul>  

                  

                    </div>   
            </nav>
    </header>
    <!-------------------------------------------------------------- section de popup add article ----------------------------------------------------------->
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
<!-- --------------------------------------------------popup commentaire -------------------------------------------------------- -->
<section class="popupCommentaire">
    <div class="modal fade" id="insertdataCommentaire" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="insertdataLabel">Commentaire</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="CMT">
<!-- comments -->

</div>

        <form method="POST" class="d-flex justify-content-center flex-column">
          <div class="user_com d-flex gap-1">
          <img src="plantes/user2.png" alt="user" style="border-radius: 50%; width:30px; height:30px">
          <div class="d-felx align-items-center">
            <textarea style="width: 200px;border-radius:7px;font-size:13px" type="text"  name="commente" placeholder="Ajouter un commentaire..."></textarea>
            </div>
            <div class="btn d-flex justify-content-center gap-1 align-items-cenr">
            <input id="articleIdPopup" type="hidden" name="articleId" value="">
            <button class="btnTags" type="submit" name="addComm" style="background-color: blue; height:30px; color:white ;font-size:12px">Publier</button>
            <button class="btnTags" type="submit" name="cancel" style="height:30px; color:blue ;font-size:12px">Annuler</button>
            </div>
          </div>

        </form>
        
        </div>
    </div>
  </div>
  </section>
<!---------------------------------------------------------------------------------------------------------------------------------->

<section class="w-100 " style="margin-top: 150px;" >
<div class="w-75 input-group rounded mx-auto my-3">
<form class="w-50 input-group rounded mx-auto md-form form-sm" method="post" action="">
  <input style="width:30vw ; height: 3vw " class="" type="text" placeholder="Search" aria-label="Search" id="Search" name="keyword">
</form>
</div>
<div class="barre d-flex justify-content-center align-items-center gap-5">

  <!-- ------------tags------------------- -->
  <div class="tags d-flex gap-3 ">
  <div><a href="article.php?id=<?php echo $idth;?>" style="font-size: 20px;color:black ; margin-left:25px">View all</a></div>
          <?php
              $req="SELECT *
              FROM tags tg
              JOIN tags_theme tgh ON tg.idTag = tgh.idTag
              JOIN themes th ON th.idTh = tgh.idTh
              WHERE th.idTh = $idth";

              $result= $conn->query($req);
              while ($row=$result->fetch_assoc()) {
                ?>
                <button class="btnTags btns" value="<?php echo $row['nomTag']?>">@<?php echo $row['nomTag']?></button>
                <?php
                }          
            ?>
  </div>
  <!-- ------------add article --------------->
  <div style="margin-left: 50px" >
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

<div id="cardT" class="w-100 row d-flex justify-content-center gap-5 test" style="margin-top:40px">
  <?php  
  $reqarticle="select idAr,nomAr,SUBSTRING(descriptionAr, 1, 60),imageAr,dateAr from articles where idTh=$idth LIMIT 6 ";
  $result=mysqli_query($conn,$reqarticle);
  while($row=mysqli_fetch_row($result)) {
   $articleId = $row[0];
  ?>
<div class="card mb-4 col- "style="width:25%">


  <div class=" mt-2 ">
    <img class="card-img-top " style="height: 20vw;" src="<?php echo $row[3]?>"

      alt="Card image cap">
  </div>


  <div class="card-body">


    <h4 class="card-title"><?php echo $row[1] ?></h4>
      <span  style="color: black;"><?php echo $row[4] ?></span>
    <p class="card-text" style="color: black;"><?php echo $row[2] ?></p>
    <div class="imogi_Read d-flex justify-content-between align-items-center">

      <div class="imogi d-flex gap-4">
            <!-- commentaire -->
            
            <button onclick="getarticleId(<?= $articleId ?>)" id="commentaire"class="btn" data-bs-toggle="modal" data-bs-target="#insertdataCommentaire">
            <svg class="imogies" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894m-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
            </svg>
            </button>
      </div>
      <div class="read d-flex justify-content-center align-items-center">
        <a  href="./oneArticle.php?id=<?php echo $articleId?>" name="read_more" id="read" class="btn btn-light-blue btn-md">Read more </a>
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
<!------------------------- Pagination ----------------------->
<div class="pagination  d-flex justify-content-center">
  <?php
  $pagination = 0;
  $page = "SELECT COUNT(idAr) as totalarticle from articles where idTh=$idth";
  $result = mysqli_query($conn, $page);
  $row = mysqli_fetch_row($result);
  $pagination = $row[0];


  $totalpage = ceil($pagination / 6);
  if ($totalpage>1) {
  ?>
    <div class="pagination d-flex gap-2 justify-content-center">
      <?php
      for ($i = 1; $i <= $totalpage; $i++) {
      ?>
        <button class="btn btn-success page" value="<?php echo $i ?>"><?php echo $i ?></button>
      <?php
      }
      ?>
    </div>
  <?php   
  }
 ?>
</div>



<?php include './include/footer.php' ?>
<script>
  let section = document.querySelector('.test');
  var Search = document.getElementById("Search");
  //affichage
  
    function fetchArticle() {
      let section = document.querySelector('.test');
      let XML = new XMLHttpRequest();
  
      XML.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          section.innerHTML = this.responseText;
        }
      };
  
      XML.open('GET', 'dataarticle.php?idTh=<?php echo $idth ?>');
      XML.send();
    }

  Search.addEventListener("input", function() {
    let s = Search.value;
    if (s === '') {
    fetchArticle();
    } else {

      let XML = new XMLHttpRequest();
      XML.onreadystatechange = function() {
        if (this.status == 200) {

          section.innerHTML = this.responseText;
        }
      }

      XML.open('GET', 'seachajax.php?search=' + s + '&idTh=<?php echo $idth ?>');
      XML.send();
    }
  });
  var pagebutton = document.querySelectorAll('.page');
  pagebutton.forEach(BTNNM => {
    BTNNM.addEventListener("click", function() {
      let pagevalue = this.value;



      let HTTP = new XMLHttpRequest();

      HTTP.onreadystatechange = function() {
        if (this.status == 200) {
          section.innerHTML = this.responseText;
        }
      }
      console.log(pagevalue);
      console.log("theme=<?php echo $idth; ?>");
      

      HTTP.open('POST', 'pagination.php');
       HTTP.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      HTTP.send("page=" + pagevalue + '&theme=<?php echo $idth ?>');

    })
  })
</script>


<script>
  function getarticleId(id){
    console.log(id);
    document.getElementById('articleIdPopup').value = id;

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
      if(this.status==200) {
          console.log(id);
          document.querySelector('.CMT').innerHTML = this.responseText;
      }
    }
    xml.open('GET','test.php?id='+id);
    xml.send();
  }



    var btntag = document.querySelectorAll('.btns');
    btntag.forEach(btn => {
      btn.addEventListener("click" , function () {
      let value = btn.value;
      console.log(value);

      let xml = new XMLHttpRequest();

      xml.onload = function () {
        if(this.status == 200 && this.readyState==4) {
          document.getElementById('cardT').innerHTML=this.responseText;

        }
      }
      var idth = "<?php echo $idth; ?>";  
       xml.open('GET', 'tags.php?TAGGid=' + value + '&idth=' + idth, true);
      // xml.open('GET','tags.php?TAGGid='+value +'&idth='<?php $idth ?> );
      xml.send();
    })
    })


    function DELETECOMMENT (id) {
          let xml = new XMLHttpRequest();

          xml.onreadystatechange = function () {
            if(this.status == 200 && this.readyState==4){
              location.reload();
            }
          }
          xml.open('GET' , 'DELETECOMMENT.php?idcom='+id);
          xml.send();
    }

    function ModifyComment (id) {
          let xml = new XMLHttpRequest();

          xml.onreadystatechange = function () {
            if(this.status == 200 && this.readyState==4){
              location.reload();
            }
          }
          xml.open('GET' , 'ModifyComment.php?idcom='+id);
          xml.send();
    }
</script>
</body>
</html>