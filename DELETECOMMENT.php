<?php
include_once('./traitement.php');
if(isset($_GET['idcom'])){
    $idcom = $_GET['idcom'];

    $REQUET = $conn->prepare("DELETE FROM commentaire WHERE idCom = '$idcom'");
    $REQUET->execute();
}

?>