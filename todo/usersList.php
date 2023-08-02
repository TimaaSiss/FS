

<?php
// Inclure les fichiers des classes Database et User
require_once './config/init.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['id'])) {
    // Récupérer l'ID de l'utilisateur administrateur actuel depuis la session
    $adminUserId = $_SESSION['id'];
    // Vérifier si l'utilisateur est un administrateur
    if (isset($_SESSION['Roles']) && $_SESSION['Roles'] === 'admin') {

        // Récupérer la liste de tous les utilisateurs depuis la base de données
        $users = $userManager->getAllUsers();
        $users = $userManager->getAllUsersExceptAdmin();
    } else {
        echo "Vous n'avez pas la permission d'accéder à cette page.";
        exit();
    }
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
  

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des rôles et des utilisateurs</title>
    <style>
      body {
            font-family: Arial, sans-serif;
            background-image: url("./assets/nice.jpg");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            color: #fd6c9e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
        select {
            padding: 6px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        
        .options {
            margin-top: 20px;
        }

        .options a {
            color: #007bff;
            text-decoration: none;
            margin-right: 20px;
        }

        .options a:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des rôles et des utilisateurs</h1>

        <!-- Afficher la liste des utilisateurs et leurs rôles -->
        <table>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Adresse e-mail</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user) : ?>
        <?php if ($user['id'] === $adminUserId) continue; ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['mail'] ?></td>
                    
                    <td><?= $user['Roles'] ?></td>
                    <td>
                       <a  href="modifierUser.php?id=<?= $user['id'] ?>">Modifier</a>
                        <a href="./traitement/user/supprimerUser.php?id=<?= $user['id'] ?>" onclick="return confirmDelete()">Supprimer</a>
                    </td>
                    <script>
                    function confirmDelete() {
                        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible !");
                    }
                   </script>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="options">
           
            <a href="profil.php">Retour au Profil</a>
        </div>
    </div>
</body>
</html>
