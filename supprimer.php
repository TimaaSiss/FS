<?php
// Inclure les fichiers des classes Database, User et Task
require_once 'database.php';
require_once 'user.php';
require_once 'tache.php';

// Établir une connexion à la base de données en utilisant la classe Database
$db = new Database('localhost', 'to do', 'root', '');
$db->connect();
$bdd = $db->getPDO();

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['id'])) {
    // Vérifier si l'identifiant de la tâche à supprimer est présent dans la requête GET
    if (isset($_GET['id'])) {
        // Récupérer l'identifiant de la tâche à supprimer
        $taskId = $_GET['id'];

        // Instancier la classe Task en passant la connexion PDO en paramètre
        $taskManager = new Task($bdd);

        // Vérifier si l'identifiant de la tâche est valide et appartient à l'utilisateur connecté
        $task = $taskManager->getTaskByIdAndUser($taskId, $_SESSION['id']);

        if ($task) {
            // Supprimer la tâche en utilisant la méthode deleteTask de la classe Task
            $taskManager->deleteTask($taskId);

            // Rediriger l'utilisateur vers la page de profil pour afficher les mises à jour
            header("Location: profil.php");
            exit();
        } else {
            echo "Cette tâche n'existe pas ou vous n'avez pas l'autorisation de la supprimer.";
        }
    } else {
        echo "Identifiant de tâche non spécifié.";
    }
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
?>

?>
