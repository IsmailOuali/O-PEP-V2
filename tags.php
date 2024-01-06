

<?php 
include './include/header.php' ;
include("traitement.php") ;
if(isset($_GET['TAGGid'])){

    $id=$_GET['TAGGid'];
    $req="SELECT * FROM articles  
    WHERE tagsAr LIKE '%$id%'";
    ;
    $res=mysqli_query($conn,$req);
    ?>
   <div class="d-flex justify-content-center gap-4">
  <?php
   while($row=mysqli_fetch_row($res)){
    ?>
    
    <div class="card mb-4  "style="width:25%">


<div style="padding: 10px;">
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
          
          <button onclick="getarticleId(<?= $articleId ?>)" id="commentaire"class="btn" data-bs-toggle="modal" data-bs-target="#insertdataCommentaire">
          <svg class="imogies" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
          <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894m-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
          </svg>
          </button>
    </div>
    <div class="read d-flex justify-content-center align-items-center">
      <button type="submit" name="read_more" id="read" class="btn btn-light-blue btn-md">Read more </button>
      <svg xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
      </svg>
    </div>

  </div>
</div>

</div>
    <?php
   }
}

?> </div>
