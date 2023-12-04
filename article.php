<?php include './include/header.php' ;
include("traitement.php") ;
$idth=$_GET['id'];
session_start();
$idUser=$_SESSION['idUtl'];

if(isset($_POST["save_data"]) ) {
    $name=$_POST['namarticle'];
    $desc=$_POST['description_a'];
    date_default_timezone_set("Africa/Casablanca");
    $date = date("Y-m-d H:i:s");

    // $i_name = $_FILES['image']['name'];
    // $i_tmp = $_FILES['image']['tmp_name'];
    // echo"".$name."".$desc."".$date."";
    // print_r($i_tmp);
    // print_r($i_name);
    // $si_extension = pathinfo($i_name, PATHINFO_EXTENSION);
    // $i_lower = strtolower($si_extension);
    // $arrytype = array("jpg", "jpeg", "png");

    // if (in_array($i_lower, $arrytype)) {
    //     $new_image = uniqid("IMG-", true) . '.' . $i_lower;
    //     $upload_path = './img/' . $new_image;
    //     move_uploaded_file($i_tmp, $upload_path);
    //     $qery="INSERT INTO articles( nomAr, descriptionAr, imageAr, dateAr, idUtl, idTh)
    //     VALUES ('$name','$desc',' $fileimg','$date','$idUser','$idth')";
       
    //     $result=mysqli_query($conn,$qery);
    //     if($result){
    //        echo 'hamid njah';
    //     }
   
    // } else {
    //     echo 'Error: invalid file extension';
    // }

   
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
      <form action="" method="post">
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
                <div >
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
                    <i class="fa-solid fa-download"></i>
                    </button>

                </div>
               
            </div>
        </div>
    </div>
</div>



<?php include './include/footer.php' ?>