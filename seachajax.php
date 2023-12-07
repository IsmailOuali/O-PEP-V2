<?php
include 'traitement.php';

if(isset($_GET['search'])) {
   ?>
   <div class="w-100 row gap-2  gap-2 mx-auto justify-content-center">
   <?php
   $search = $_GET['search'];
   $idth = $_GET['idTh'];
   $reqarticle = "select * from articles where idTh=$idth and nomAr LIKE '%$search%'  ";
    $result = mysqli_query($conn, $reqarticle);
   if($result){
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