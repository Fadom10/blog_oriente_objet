 <?php

    require_once '../includes/config.php';

    $pt = new PostTable();
    $pc = new PostCat();
    session_start();
   

    //ENVOYER FORMULAIRE CREER ARTICLE
    if (isset($_POST['crea_cat'])) {
        $cat = new Cat();
        $cat->setCategorie($_POST['new_cat']);
        $pc->create($cat);
        header('location:index.php');
    }

    //SUPPRIMER POST
    if (isset($_GET['del'])) {
        $getid = intval($_GET['del']);
        $pt->delete($getid);
        header('location:index.php');
    }
    //APPUI ENVOYER ARTICLE
    if (isset($_POST['submit'])) {
        $post = new Post();
        $post->setTitle($_POST['titre']);
        $post->setContent($_POST['article']);
        $post->setCat($_POST['cat']);
        $pt->create($post);
        header('location:index.php');
    }


    $posts = $pt->all();
    $cats = $pc->all();

    ?>
 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <title>Blog</title>


     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </head>

 <body>

 
     <div class="container">
         <h1 class="text-center">Blog</h1>
        <?php 
        if (empty($_SESSION['pseudo'])) //On est dans la page de formulaire
    {
        
    }
    else {
        $pseudo= $_SESSION['pseudo'];
        echo 'Bienvenue '.$pseudo;

    } ?>
         <!-- Button trigger modal -->
         <?php 
         if (empty($_SESSION['pseudo'])){
         echo '<br> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
             CONNEXION
         </button>';
         }
         else {
         echo '<br> <form method="post" action="../includes/deconnexion.php"> <input type="submit" class="btn-primary" name="deco" id="deco" value="DECONNEXION" />
         </form>';
         };
        ?>
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Connexion d'utilisateur</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form method="post" action="../includes/connexion.php">
                             <fieldset>
                                 <legend>Connexion</legend>
                                 <p>
                                     <label for="pseudo">Pseudo :</label><input class="form-control" name="pseudo" type="text" id="pseudo" /><br />
                                     <label for="password">Mot de Passe :</label><input class="form-control" type="password" name="password" id="password" />
                                 </p>
                             </fieldset>
                             <p><input class="btn-primary" type="submit" value="Connexion" /></p>
                         </form>
                     </div>
                 </div>
             </div>
         </div>

         <HR size=2 width="100%">
         <a href="./secret.php">Votre page secrete.</a>
         <div class="creation">

             <!--DEBUT FORMULAIRE DE POST -->
             <div class="post">
                 <form method="post" action="">
                     <label for="titre">Titre : </label><input class="form-control" required type="text" name="titre" id="titre" placeholder="Entrez le titre..." maxlength="50" /><br />

                     <label for="cat">Catégorie:</label><br />
                     <select class="form-control" name="cat" id="cat">
                         <!-- DEBUT FETCH CATEGORIE -->
                         <?php foreach ($cats as $cat) : ?>
                             <div class="col-md-4">
                                 <option value="<?= $cat['id']; ?>"><?php echo $cat['categorie']; ?></option><br>
                                 <HR size=2 width="100%">
                             </div>
                         <?php endforeach; ?>
                         <!-- FIN FETCH -->


                     </select> <br>
                     <label for="article">Article : </label><br /><textarea class="form-control" required name="article" id="article" placeholder="Ecrivez votre article ici..." cols="30" rows="4"></textarea><br />
                     <input type="submit" class="btn-primary" name="submit" id="submit" value="Envoyer" />
                 </form>
             </div>
             <HR size=2 width="100%">
             <!-- FIN DU FORMULAIRE-->
         </div>
         <!-- DEBUT FORMULAIRE CATEGORIE -->
         <form method="post" action="">
             <label for="titre">Creer une catégorie: </label><input class="form-control" required type="text" name="new_cat" id="new_cat" placeholder="Entrez la catégorie..." maxlength="50" /><br />
             <input class="btn-primary" type="submit" name="crea_cat" id="crea_cat" value="Creer" />
         </form>
         <!-- FIN FORMULAIRE -->
         <HR size=2 width="100%">

         <div class="row">
             <!-- DEBUT FETCH DES ARTICLES -->
             <?php foreach ($posts as $post) : ?>
                 <div class="col-md-4">
                     <h2><?= $post['title'] ?></h2>
                     <i>
                         <h3><?= $pt->get_cat_by_id($post['id_cat']) ?></h3>
                     </i>
                     <p><?= $post['content'] ?></p>

                     <a class="btn btn-primary " href="index.php?del=<?= $post['id'] ?>" role="button" id="supp" name="supp">Supprimer</a>

                     <a class="btn btn-primary " href="../includes/modif.php?num=<?= $post['id'] ?>" role="button" id="modif" name="modif">Modifier</a>


                     <HR size=2 width="100%">
                 </div>
             <?php endforeach; ?>
             <!-- FIN FETCH -->
         </div>
     </div>
 </body>

 </html>
 <style>


 </style>