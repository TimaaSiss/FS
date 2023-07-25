<!DOCTYPE html>
<html>
<head>
    <title>Profil Utilisateur</title>
    <style>
        body {
            background-image: url("do.png");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2 {
            margin-top: 0;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .task-stats {
            margin-bottom: 20px;
        }
        .recent-tasks {
            margin-bottom: 20px;
        }
        .task {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .options {
            text-align: right;
        }
        .options a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Utilisateur</h2>
        
        <?php
        require_once 'database.php';
        require_once 'user.php';
        require_once 'tache.php';

        // Établir une connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=to do', 'root', '');
        $userManager = new User($bdd);
        $taskManager = new Task($bdd);

        // Vérifier si l'utilisateur est connecté
        session_start();
        if (isset($_SESSION['id'])) {
            // Récupérer les informations de l'utilisateur connecté
            $id = $_SESSION['id'];
            $user = $userManager->getUserbyId($id);

            // Afficher les informations de l'utilisateur
            echo '<div class="profile-info">';
            echo '<h3>Informations Utilisateur</h3>';
            echo '<p>Nom d\'utilisateur: ' . $user['username'] . '</p>';
            echo '<p>Adresse e-mail: ' . $user['mail'] . '</p>';
            echo '</div>';

            // Mettre à jour les statistiques des tâches
            $taskStatus = $userManager->getTaskStatus($id);

            echo '<div class="task-stats">';
            echo '<h3>Statistiques des Tâches</h3>';
            echo '<ul class="task-list">';
            echo '<li class="task-item">';
            echo '<p>Total des Tâches: ' . $taskStatus['total_tasks'] . '</p>';
            echo '<p>Tâches Terminées: ' . $taskStatus['completed_tasks'] . '</p>';
            echo '<p>Tâches en Cours: ' . $taskStatus['in_progress_tasks'] . '</p>';
            echo '</li>';
            echo '</ul>';

            // Ajouter une nouvelle tâche
            if (isset($_POST['task_name'])) {
                $task_name = $_POST['task_name'];
                $taskManager->createTask($id, $task_name);


                // Rediriger l'utilisateur vers la page de profil pour afficher les mises à jour
                header("Location: profil.php");
                exit();
            }

            echo '<form class="add-task-form" method="POST" action="">';
            echo '<input type="text" name="task_name" placeholder="Ajouter une nouvelle tâche" required>';
            echo '<input type="submit" value="Ajouter">';
            echo '</form>';

            echo '</div>';

            // Récupérer les tâches récentes de l'utilisateur
            $recentTasks = $taskManager->getRecentTasks($id, 5);


            echo '<div class="recent-tasks">';
            echo '<h3>Tâches Récentes</h3>';
            foreach ($recentTasks as $task) {
                $t =  '<p>' . $task['task_name'] . ' <a href="modifier.php?id=' . $task['id'] . '">Modifier</a> <a href="supprimer.php?id=' . $task['id'] . '">Supprimer</a>';
                if($task['status']!="completed"){
                    $t .= '<a href="terminer.php?id=' . $task['id'] . '">Terminer</a>';
                }
                $t .= '</p>';
                echo $t;
            }
            echo '</div>';



            // Vérifier si le formulaire de changement de mot de passe a été soumis
            if (isset($_POST['new_password'])) {
                $new_password = $_POST['new_password'];
                // Hasher le nouveau mot de passe
               $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Mettre à jour le mot de passe de l'utilisateur dans la base de données
            $userManager->updatePassword($id, $hashed_password); }
                } else {
            // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
            header("Location: connexion.php");
            exit();
        }
        ?>
     
       <form class="change-password-form" method="POST" action="">
    <h3>Modifier le Mot de Passe</h3>
    <input type="password" name="new_password" placeholder="Nouveau Mot de Passe" required>
    <input type="submit" value="Modifier">
</form>

        <div class="options">
             <a href="historique.php">Historique des taches</a>    /   <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</body>
</html>

