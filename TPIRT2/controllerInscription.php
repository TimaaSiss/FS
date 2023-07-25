<?php
session_start();
require_once('inscriptionmodel.php');

if (isset($_POST['forminscription'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $motdepasse = sha1($_POST['password']);
    $motdepasse2 = sha1($_POST['password2']);

    // Validation des données
    if (validerDonneesInscription($pseudo, $email, $_POST['password'], $_POST['password2'])) {
        // Appel de la fonction d'inscription du modèle
        if (inscriptionUtilisateur($pseudo, $email, $motdepasse)) {
            $_SESSION['message'] = "Votre compte a bien été créé!";
            header("Location: accueil.php");
            exit();
        } else {
            $erreur = "Une erreur s'est produite lors de l'inscription";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés et les mots de passe doivent correspondre";
    }
}

// Inclure la vue
require_once('inscription.php');
?>



