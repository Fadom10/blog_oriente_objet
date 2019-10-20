 <?php

    require_once '../includes/config.php';

    $pt = new PostTable();
    $pc = new PostCat();


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
 </head>

 <body>


     <div class="container">
         <h1 class="text-center">Blog</h1>

         <HR size=2 width="100%">
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