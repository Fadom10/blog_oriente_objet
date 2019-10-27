<?php

require_once '../includes/config.php';
session_start();
session_destroy();
echo '<p>Vous êtes à présent déconnecté <br />
<br />Cliquez <a href="../public/index.php">ici</a> 
pour revenir à la page d accueil</p>';
exit;
?>