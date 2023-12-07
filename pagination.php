<?php
include 'traitement.php';
if(isset($_POST['page']) && isset($_POST['theme'])) {
    $page = $_POST['page']; // page 1
    $theme = $_POST['theme']; // theme 1

    $pagination = ($page - 1)*6;
    $req=$conn->prepare("select * from articles where idTh=? LIMIT  ?,6");
    $req->bind_param("ii", $theme,$pagination);
    $req->execute();
    $resulttt = $req->get_result();
    
    // echo $resulttt->num_rows;
   
    ?>
   <div class="w-100 row  gap-2 mx-auto justify-content-center">
   <?php
        while($row =mysqli_fetch_row($resulttt)) {
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

?>