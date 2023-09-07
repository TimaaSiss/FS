<!DOCTYPE html>
<html>
<head>

	<title>Tableau des utilisateurs</title>

</head>
<body>
 
 <?php
// Tableau d'utilisateurs
$fusers = array(
    array("utilisateur1", "motdepasse1"),
    array("utilisateur2", "motdepasse2"),
    array("utilisateur3", "motdepasse3")
);

// Vérification des informations d'authentification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomUtilisateur = $_POST["nom_utilisateur"];
    $motDePasse = $_POST["mot_de_passe"];

    // Vérifiez les informations d'authentification avec le tableau d'utilisateurs
    $authentificationReussie = false;

    foreach ($fusers as $utilisateur) {
        if ($utilisateur[0] === $nomUtilisateur && $utilisateur[1] === $motDePasse) {
            $authentificationReussie = true;
            break;
        }
    }

    if ($authentificationReussie) {
        // Redirection vers la page "notresite.php" si l'authentification est réussie
        header("Location: notresite.php");
        exit();
    }
}
?>

















