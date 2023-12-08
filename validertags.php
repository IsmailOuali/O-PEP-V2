

<?php 
include './include/header.php' ;
include("traitement.php") ;
if(isset($_GET['tag'])){
    // echo''.$_GET['tag'].'';
    $id=$_GET['tag'];
    $req="SELECT tags.nomTag,tags_theme.idTag,tags_theme.idTh FROM tags_theme, tags where tags_theme.idTag=tags.idTag and tags_theme.idTh= $id";
    $res=mysqli_query($conn,$req);
    ?>
   <div >
  <?php
   while($row=mysqli_fetch_row($res)){
    ?>
    
    <a href="deletetag.php?id=<?php echo $row[1] ?>&idth=<?php echo $row[2] ?>" style=" background-color: #f44336; border-radius:40px;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-excel" viewBox="0 0 16 16">
  <path d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
</svg><?php echo $row[0] ?></a>
    <?php
   }
}

?> </div>
<?php include './include/footer.php' ?>