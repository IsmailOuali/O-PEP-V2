<?php include './include/header.php';
include("traitement.php");
$idth = $_GET['id'];
session_start();
$idUser = $_SESSION['idUtl'];
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
    $qery = "INSERT INTO articles( nomAr, descriptionAr, imageAr, dateAr, idUtl, idTh)
        VALUES ('$name', '$desc', '$upload_path','$date','$idUser','$idth')";
    $result = mysqli_query($conn, $qery);
  }
}

?>
<!-- insert modal -->
<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
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
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <input type="submit" name="save_data" class="btn btn-primary" value="Save Data"></input>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="">
        <div>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
            <!-- <i class="fa-solid fa-download"></i> -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="26" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
          </button>

        </div>

      </div>
    </div>
  </div>
</div>
<form class="form-inline w-25 d-flex justify-content-center md-form form-sm" method="post" action="">
  <input class="form-control border border-success form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search" id="Search" name="keyword">
</form>

<section class="test w-100 mt-3">
  <!-- content-->

  <div class="w-100 row gap-2 mx-auto justify-content-center  ">
    <?php
    if (!isset($_GET['search']) || empty($_GET['search'])) {

      $reqarticle = "SELECT * from articles where idTh=$idth LIMIT 6";
      $result = mysqli_query($conn, $reqarticle);
      if ($result) {
        while ($row = mysqli_fetch_row($result)) {


    ?>

          <div class="card mb-4 col-" style="width:30%">

            <div class="mt-2 text-center">
              <img class="card-img-top text-center" style="width: 20vw; height: 20vh;" src="<?php echo $row[3] ?>" alt="Card image cap">
            </div>

            <div class="card-body">
              <h4 class="card-title"><?php echo $row[1] ?></h4>
              <span class="mask rgba-white-slight text-success"><?php echo $row[4] ?></span>
              <p class="card-text"><?php echo $row[2] ?></p>
              <button type="button" class="btn btn-light-blue btn-md">Read more</button>
            </div>

          </div>

    <?php
        }
      }
    }
    ?>
  </div>
 
</section>

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
    //pagination
  var pagebutton = document.querySelectorAll('.page');
  pagebutton.forEach(BTNNM => {
    BTNNM.addEventListener("click", function() {
      let pagevalue = this.value;
      Search.value="";


      let HTTP = new XMLHttpRequest();

      HTTP.onreadystatechange = function() {
        if (this.status == 200) {
          section.innerHTML = this.responseText;
        }
      }

      HTTP.open('POST', 'pagination.php');
       HTTP.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      HTTP.send("page=" + pagevalue + '&theme=<?php echo $idth ?>');
    })
  })
</script>
<?php include './include/footer.php' ?>