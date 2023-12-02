<?php

include("traitement.php") ;

//-------------------------------- INSCRIPTION-----------------------------------------
if (isset($_POST['submitInsc'])) {

    $nom = $_POST["nomInsc"];
    $prenom = $_POST["prenomInsc"];
    $email = $_POST["emailInsc"];
    $mdp = $_POST["mdpInsc"];
    
    if (!empty($email) && !empty($mdp) && !empty($nom) && !empty($prenom)) {
        $query = "INSERT INTO utilisateurs ( emailUtl,mdpUtl,nomUtl,prenomUtl) VALUES ('$email','$mdp','$nom','$prenom')";
        $result = $conn->query($query);
        if($result){
            $lastUserId = $conn->insert_id;
            header("Location: role.php?id=$lastUserId");
        }
    } else 
        echo "<script>alert('Remplir tous les champs')</script>";
   
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body style="background-color: #132A13 ">
    <section class="sec1 ">
        <div class="overlay" id="overlay"></div>
        <!-- Section: Design Block -->
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5 mt-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color:aliceblue; font-size: 3.2vw;">
                        The best offer <br />
                    </h1>
                    <p class="mb-4 opacity-70" style="color:aliceblue; font-size: 1.2vw;">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Temporibus, expedita iusto veniam atque, magni tempora mollitia
                        dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                        ab ipsum nisi dolorem modi. Quos?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div class="card bg-glass" style="width: 28vw;">
                        <div class="card-body px-4 py-5 px-md-5">

                            <!-- --------------------------------------------------Form_Inscription -------------------------------------------->
                            <form method="POST" id="_______inscriptionForm2">
                                <!-- nom input -->
                                <div class="form-outline mb-4">
                                    <input type="text" name="nomInsc" class="form-control" placeholder="Nom" />
                                </div>

                                <!-- prenom input -->
                                <div class="form-outline mb-4">
                                    <input type="text" name="prenomInsc" class="form-control" placeholder="Prenom" />
                                </div>
                                
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="emailInsc" class="form-control" placeholder="Email address" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="mdpInsc" class="form-control" placeholder="Password" />
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="submitInsc" id="submitInsc" class="btn btn-block mb-4" style="background-color: #132A13; color:white" >
                                    S'inscrire
                                </button>

                                <!-- Inscription button -->
                                <a href="connection.php" >
                                    Se connecter
                                </a>
                            </form>
                            <!-- ------------------------------------------------------Fin ------------------------------------------------------------->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="javascripte.js"></script>
</body>

</html>