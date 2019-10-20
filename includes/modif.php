<?php


require_once '../includes/config.php';

$pt = new PostTable();

$post=$pt->get($_GET['num']);

//ENVOYER FORMULAIRE MODIFIER
if (isset($_POST['update'])) {
    $pt->update($post);
    header('location: ../public/index.php');
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Blog</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h1 class="text-center">EDITION</h1>
        <HR size=2 width="100%">
        <div class="creation">

            <!--DEBUT FORMULAIRE D'EDITION -->
            <div class="post">
                <form method="post" action="">
                    
                    <label for="titre">Titre : </label><input class="form-control" required type="text" name="titre" id="titre" value="<?= $post->getTitle() ?>" placeholder="Entrez le titre..." maxlength="50"> <br />

                    <label for="article">Contenu : </label><br /><input class="form-control" required type="text" name="article" id="article" value="<?= $post->getContent() ?>" placeholder="Ecrivez votre article ici..." cols="30" rows="4"></textarea><br />
                    <input class="btn-primary" type="submit" name="update" id="update" value="Modifier" />
                </form>
            </div>
            <HR size=2 width="100%">
            <!-- FIN DU FORMULAIRE-->
        </div>
</body>

</html>