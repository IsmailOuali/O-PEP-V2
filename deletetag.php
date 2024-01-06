<?php 
include("traitement.php") ;
if(isset($_GET["id"])&& isset($_GET['idth']) ){
    $id = $_GET["id"];
    $idth = $_GET["idth"];
    // echo"".$id."";
    // echo "".$idth."";
 $delet="DELETE tags_theme
FROM tags_theme
JOIN themes ON tags_theme.idTh =  $idth
WHERE tags_theme.idTag = $id;";
    $result = mysqli_query($conn,$delet);
    if($result){
        header("Location: admin.php");
        exit();
    }


}

?>