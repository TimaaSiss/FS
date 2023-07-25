CONNEXION 

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
        input[type="mail"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"] {
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
        require_once 'database.php';
        require_once 'user.php';
        
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Créer une instance de la classe Database en passant les informations de connexion
            $database = new Database('localhost', 'to do', 'root', '');

            // Connecter à la base de données
            $database->connect();

            // Récupérer les données du formulaire
            $email = $_POST['mailconnect'];
            $password = $_POST['mdpconnect'];

            // Créer une instance de la classe User en passant la connexion PDO en paramètre
            $userManager = new User($database->getPDO());

            // Vérifier les informations de connexion dans la base de données
            $userAuthenticated = $userManager->authenticateUser($email, $password);
            if ($userAuthenticated) {
                // Connexion réussie
                session_start();
                $_SESSION['email'] = $email; // Vous pouvez également stocker l'ID de l'utilisateur si nécessaire
                header("Location: profil.php");
                exit();
            } else {
                // Mauvaises informations de connexion
                $erreur = "Identifiants invalides. Veuillez réessayer.";
            }
        }
        ?>

    <form method="POST" action="">
            <label for="mailconnect">Mail:</label>
            <input type="mail" id="mailconnect" name="mailconnect" placeholder="Mail" required><br>
            <label for="mdpconnect">Mot de passe:</label>
            <input type="password" id="mdpconnect" name="mdpconnect" placeholder="Mot de passe" required><br>
            <input type="submit" name="formconnect" value="Se connecter"><br>
        </form>
    
        <?php 
        if (isset($erreur)) {
            echo '<p class="error">' . $erreur . '</p>';
        }
        ?>
    </div>
</body>
</html>

