<?php

session_start();

require_once '../includes/config.php';
$message='';
if (empty($_SESSION['pseudo'])){
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="../public/index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT id, pseudo, m_password FROM membre WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['m_password'] == $_POST['password']) // Acces OK !
	{
	    $_SESSION['pseudo'] = $data['pseudo'];
	    $_SESSION['id'] = $data['id'];
	    $message = '<p>Bienvenue '.$data['pseudo'].', 
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="../public/index.php">ici</a> 
			pour revenir à la page d accueil</p>';  
	}
	else // Acces pas OK !
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p>
	    <br /><br />Cliquez <a href="../public/index.php">ici</a> 
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
else {echo 'Vous êtes déjà connecté !!
	<br>Cliquez <a href="../public/index.php">ici</a> 
	pour revenir à la page d accueil</p>';}
?>

