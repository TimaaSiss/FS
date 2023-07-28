<?php
// Détruire la session en cours
session_start();
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil
header("Location:../../");
exit();
?>
