 <?php

    require_once '../includes/config.php';
    session_start();

    ?>

 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <title>PAGE SECRETE ADMIN</title>


     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </head>

 <body>


     <div class="container">
         <h1 class="text-center">SECRET</h1>
         <?php
            if (empty($_SESSION['pseudo'])) //On est dans la page de formulaire
            {
                echo 'SEUL LES PROFIL CONNECTE ONT ACCES A CETTE PAGE !!
<br />Cliquez <a href="../public/index.php">ici</a> 
pour revenir à la page d accueil</p>';
            } else {
                $pseudo = $_SESSION['pseudo'];
                echo 'Bienvenue dans votre page secrete ' . $pseudo;
                echo '<br> <br> <iframe src="https://giphy.com/embed/l3mZqVbeXSNQQrBu0" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                    <br />Cliquez <a href="../public/index.php">ici</a> 
pour revenir à la page d accueil</p>';
            } ?>

 </body>

 </html>
 <style>


 </style>