<?php
include_once('./traitement.php');
session_start();
if(isset($_SESSION['idUtl'])){
  $idsession = $_SESSION['idUtl'];
}

$req2 = "SELECT nomUtl FROM utilisateurs u
         WHERE u.idUtl = $idsession";
$result2 = $conn->query($req2);
$row2 = $result2->fetch_assoc();

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    //affichage
    $req = "SELECT c.contenuCom , c.idCom , u.nomUtl , u.idUtl
    FROM articles a , utilisateurs u , commentaire c
    where c.idUtl = u.idUtl and a.idAr = c.idAr and a.idAr= $id";

    $result_Affiche = $conn->query($req);


while ($row = $result_Affiche->fetch_assoc() ) {
    ?>
    <div class="commentTex d-flex flex-column">
      <div class="div1 d-flex">
        <img src="plantes/user2.png" alt="user" style="border-radius: 50%; width:30px; height:30px">
        <h5><?php echo $row['nomUtl']; ?></h5>
      </div>
      <?php echo $row['contenuCom']; ?>
      <?php if($idsession == $row['idUtl']){?>
      <div class="Mod_Del d-flex gap-2">
        <a style="cursor: pointer;  color:red" onclick="DELETECOMMENT(<?php echo $row['idCom']?>)">Delete</a>
        <a style="cursor: pointer;  color:blue" onclick="">Modify</a>
      </div>
      <?php }?>
      <div class="mt-4"></div>
    </div>
  <?php
    }
}

?>