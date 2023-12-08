<?php
include_once('./traitement.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
$req = "SELECT * FROM commentaire c
join articles a 
where a.idAr=c.idAr and a.idAr= $id";

$result = $conn->query($req);
  while ($row = $result->fetch_assoc()) {

?>
  <div class="commentTex d-flex">
    <img src="plantes/user2.png" alt="user" style="border-radius: 50%; width:30px; height:30px">
    <p><?php echo $row['contenuCom']; ?></p>
  </div>
<?php
  }
}

?>