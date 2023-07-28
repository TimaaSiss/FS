<?php
require_once './config/init.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['motdepasse'];
    
    // Valider les données du formulaire (exemples de validations)
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse e-mail invalide.";
    } else {
        // Hasher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Appeler la méthode createUser pour effectuer l'inscription
    $result = $userManager->createUser($username, $email, $password);

    if ($result) {
        // L'inscription s'est bien déroulée, redirige l'utilisateur vers une autre page par exemple
        header("Location: accueil.php");
        exit();
    } else {
        // Une erreur s'est produite lors de l'inscription, tu peux afficher un message d'erreur par exemple
        $error_message = "Une erreur s'est produite lors de l'inscription.";
    }
}
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <style>
    body {
        background-image: url("doit.jpg");
        background-size: cover;
        background-position: center;
    }
    .container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
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
    input[type="text"],
    input[type="password"] {
        width: 100%;
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
    <h1>WELCOME TO OUR WEBSITE <strong>MY TO-DO LIST</strong></h1></br>

    <h3>Veuillez vous inscrire pour acceder a beaucoup plus de fonctionnalités</h3>

    <div class="container">
        <h2>Inscription</h2>
        
        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        
        <form method="post" action="">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" required>

            <label for="mail">Email:</label>
            <input type="text" name="mail" required>
            
            <label for="motdepasse">Mot de passe:</label>
            <input type="password" name="motdepasse" required>
            
            <label for="confirm_password">Confirmer le mot de passe:</label>
            <input type="password" name="confirm_password" required>
            
            <input type="submit" value="S'inscrire">
        </form>
        
        <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
    </div>
</body>
</html>
