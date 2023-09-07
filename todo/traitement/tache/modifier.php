<?php
require_once '../../config/init.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['id'])) {
    // Vérifier si l'ID de la tâche est présent dans l'URL
    if (isset($_GET['id'])) {
        $task_id = $_GET['id'];

        // Vérifier si la tâche appartient à l'utilisateur connecté
        $user_id = $_SESSION['id'];
        $task = $taskManager->getTaskByIdAndUser($task_id, $user_id);

        if ($task) {
            // Le formulaire a été soumis pour mettre à jour la tâche
            if (isset($_POST['task_name'])) {
                $task_name = $_POST['task_name'];

                // Mettre à jour la tâche en utilisant la méthode updateTaskName de la classe Task
                $taskManager->updateTaskName($task_id, $task_name);

                // Rediriger l'utilisateur vers la page de profil
                header("Location: ../../profil.php");
                exit();
            }

            // Afficher le formulaire de modification de la tâche avec la tâche pré-remplie
            echo '<form method="POST" action="">';
            echo '<input type="text" name="task_name" value="' . $task['task_name'] . '" required>';
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
        } else {
            // La tâche ne fait pas partie des tâches de l'utilisateur
            echo 'Erreur : Tâche non trouvée';
        }
    } else {
        // L'ID de la tâche n'est pas présent dans l'URL
        echo 'Erreur : ID de tâche manquant';
    }
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../../connexion.php");
    exit();
}
?>
