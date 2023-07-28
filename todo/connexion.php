<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
      body {
            background-image: url("doit.jpg");
            background-size: cover;
            background-position: center;
        }
        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 40px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            margin-top: 0;
            color: #007bff;
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"],
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php
        
        // Inclure la classe Database
        require_once './config/init.php';
        
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer les données du formulaire
            $email = $_POST['mailconnect'];
            $password = $_POST['mdpconnect'];

            // Vérifier les informations de connexion dans la base de données
            $userAuthenticated = $userManager->authenticateUser($email, $password);
            if ($userAuthenticated) {
                // Connexion réussie
                session_start();
                $user = $userManager->getUserbyEmail($email);
                $_SESSION['id'] = $user['id']; // Vous pouvez également stocker l'ID de l'utilisateur si nécessaire
                 $_SESSION['Roles'] = $user['Roles'];
                header("Location: profil.php");
                exit();
            } else {
                // Mauvaises informations de connexion
                $erreur = "Identifiants invalides. Veuillez réessayer.";
            }
        }

        ?>

        <form method="post" action="">
            <label for="mailconnect">Mail:</label>
            <input type="email" id="mailconnect" name="mailconnect" placeholder="Mail" required/><br>
            <label for="mdpconnect">Mot de passe:</label>
            <input type="password" id="mdpconnect" name="mdpconnect" placeholder="Mot de passe" required/><br>
            <button>Se connecter</button><br>
        </form>
    
        <?php 
        if (isset($erreur)) {
            echo '<p class="error">' . $erreur . '</p>';
        }
        ?>
    </div>
</body>
</html>

