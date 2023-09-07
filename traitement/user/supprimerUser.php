<?php
// Inclure les fichiers des classes Database et User
require_once '../../config/init.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['Roles']) && $_SESSION['Roles'] === 'admin') {
    // Vérifier si l'identifiant de l'utilisateur à supprimer est présent dans la requête GET
    if (isset($_GET['id'])) {
        // Récupérer l'identifiant de l'utilisateur à supprimer
        $userId = $_GET['id'];

        // Supprimer l'utilisateur en utilisant la méthode deleteUser de la classe User
        $userManager->deleteUser($userId);

        // Rediriger l'administrateur vers la page de liste des utilisateurs pour afficher les mises à jour
        header("Location: ../../usersList.php");
        exit();
    } else {
        echo "Identifiant d'utilisateur non spécifié.";
    }
} else {
    echo "Vous n'avez pas la permission d'accéder à cette page.";
}
?>
