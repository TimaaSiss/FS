<?php
session_start();
require_once('modelconnexion.php');

if (isset($_POST['formconnect'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (validerDonneesConnexion($mailconnect, $mdpconnect)) {
        $result = authentifierUtilisateur($mailconnect, $mdpconnect);

        if ($result['success']) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['email'] = $result['email'];
            header("Location: accueil.php");
            exit();
        } else {
            $erreur = $result['message'];
        }
    } else {
        $erreur = "Tous les champs doivent être complétés!";
    }
}

// Inclure la vue
require_once('connexion.php');
?>


