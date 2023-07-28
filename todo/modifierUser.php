<?php
require_once './config/init.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (isset($_SESSION['id'])) {
    // Vérifier si l'administrateur est connecté
    if ($_SESSION['Roles'] === 'admin') {
        // Vérifier si l'identifiant de l'utilisateur à modifier est présent dans la requête GET
        if (isset($_GET['id'])) {
            // Récupérer l'identifiant de l'utilisateur à modifier
            $userId = $_GET['id'];

            // Vérifier si l'utilisateur existe
            $user = $userManager->getUserbyId($userId);

            if ($user) {
                // Vérifier si le formulaire de modification des autres informations a été soumis
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Récupérer les informations du formulaire de modification des autres informations
                    $newUsername = $_POST['username'];
                    $newEmail = $_POST['email'];
                    $newPassword = $_POST['password'];

                    // Valider les champs requis
                    $errors = array();
                    if (empty($newUsername)) {
                        $errors[] = "Le nom d'utilisateur est requis.";
                    }
                    if (empty($newEmail)) {
                        $errors[] = "L'adresse e-mail est requise.";
                    }

                    // Si les champs sont valides, mettre à jour les autres informations de l'utilisateur
                    if (empty($errors)) {
                       // Mettre à jour les informations de l'utilisateur en utilisant la méthode updateUser de la classe User
                        $update = $userManager->updateUser($userId, $newUsername, $newEmail, $newPassword);
                        $successMessage = "L'utilisateur a été modifié avec succès."; 
                        $user = $userManager->getUserbyId($userId);
                    }
                }

                // Vérifier si le formulaire de modification du rôle a été soumis
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newRole'])) {
                    // Récupérer le nouveau rôle sélectionné pour l'utilisateur
                    $newRole = $_POST['newRole'];

                    // Mettre à jour le rôle de l'utilisateur

                    $update = $userManager->updateUserRole($userId, $newRole);
                    if($update == 'true'){
                       // Afficher un message de succès pour les autres informations
                        $successMessageRole = "Le rôle de l'utilisateur a été modifié avec succès.";
                        $user = $userManager->getUserbyId($userId);
                    }else{
                        // Afficher un message de succès pour les autres informations
                        $successMessageRole = $update;
                    }

                    // Afficher un message de succès pour la modification du rôle
                    
                }
            } else {
                echo "Cet utilisateur n'existe pas.";
            }

        } else {
            echo "Identifiant d'utilisateur non spécifié.";
        }
    } else {
        echo "Vous n'avez pas la permission de modifier cet utilisateur.";
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
    <title>Modifier l'utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }
        button {
    background-color: #800080;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier l'utilisateur</h1>
        <?php
        // Afficher les messages d'erreur s'il y en a
        if (!empty($errors)) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }

        // Afficher le message de succès s'il existe
        if (isset($successMessage)) {
            echo '<div class="success">';
            echo '<p>' . $successMessage . '</p>';
            echo '</div>';
        }

        // Afficher le message de succès s'il existe
        if (isset($successMessageRole)) {
            echo '<div class="success">';
            echo '<p>' . $successMessageRole . '</p>';
            echo '</div>';
        }
        ?>

<form method="post" action="">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" value="<?= $user['username'] ?? '' ?>" required><br>
    <label for="email">Adresse e-mail:</label>
    <input type="text" id="email" name="email" value="<?= $user['mail'] ?? '' ?>" required><br>
    <label for="password">Nouveau mot de passe:</label>
    <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="6"><br>
   


   <label for="newRole">Nouveau rôle:</label>
   <label for="newRole">Rôle:</label>
    <select name="newRole" id="newRole" required>
        <option value="admin" <?= $user['Roles'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['Roles'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
    </select>
     </br>
      </br>
     <button type="submit">Enregistrer</button>
    </form>

        <p><a href="usersList.php">Gestions des roles et utilisateurs</a></p>
    </div>
</body>
</html>
