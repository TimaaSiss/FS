<?php
// terminer.php

require_once '../../config/init.php';

$bdd = new PDO('mysql:host=localhost;dbname=todo', 'root', '');
$taskManager = new Task($bdd);

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $taskManager->markTaskAsCompleted($task_id);

    // Rediriger l'utilisateur vers la page de profil après avoir marqué la tâche comme terminée
    header("Location: profil.php");
    exit();
}
?>
