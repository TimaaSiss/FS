<?php
require_once 'tache.php';
require_once 'database.php';

if (isset($_GET['id'])) {
    // Récupérer l'identifiant de la tâche à supprimer depuis l'URL
    $taskId = $_GET['id'];

    // Instancier la classe Database et établir la connexion
    $database = new Database('localhost', 'to do', 'root', '');
    $database->connect();

    // Utiliser l'objet PDO de la classe Database pour instancier la classe Task
    $taskManager = new Task($database->getPDO());

    // Supprimer la tâche en utilisant la méthode deleteTask de la classe Task
    $taskManager->deleteTask($taskId);

    // Rediriger l'utilisateur vers la page historique après la suppression
    header("Location: historique.php");
    exit();
}
?>
