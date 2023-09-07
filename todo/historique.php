<?php
require_once './config/init.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $user = $userManager->getUserbyId($id);

    // Récupérer toutes les tâches de l'utilisateur
    $allTasks = $taskManager->getTasks($id);
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Historique des Tâches</title>
  <style>
        body {
            background-image: url("./assets/do.png");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <h2>Historique des Tâches de <?php echo $user['username']; ?></h2>

    <ul>
        <?php foreach ($allTasks as $task) :

$t =  '<p>' . $task['task_name'] . ' <a href="./traitement/tache/modifier.php?id=' . $task['id'] . '">Modifier</a> <a href="./traitement/tache/supprimer.php?id=' . $task['id'] . '">Supprimer</a>';
if($task['status']!="completed"){
    $t .= ' <a href="./traitement/tache/terminer.php?id=' . $task['id'] . '">Terminer</a>';
}
$t .= '</p>';
echo $t;
    
    ?>
            <li><?php echo $task['task_name']; ?> (Statut : <?php echo $task['status']; ?>)</li>
        <?php endforeach; ?>
    </ul>

     <a href="profil.php">Retour au Profil</a>
   
</body>
</html>
