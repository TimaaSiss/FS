<!-- inscription.php -->
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="POST" action="controllerInscription.php">
        <h2>Inscription</h2>
        <label>Pseudo:</label> <input type="text" name="pseudo" placeholder="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>"><br>
        <label>Email:</label> <input type="text" name="email" placeholder="email" value="<?php if(isset($email)){ echo $email;} ?>"><br>
        <label>Mot de passe:</label><input type="password" name="password" placeholder="Mot de passe"><br>
        <label>Confirmer votre Mot de passe:</label><input type="password" name="password2" placeholder="Confirmer Mot de passe"><br>
        <input type="submit" name="forminscription" value="S'inscrire"><br>

        <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
    </form>

    <?php 
    if(isset($erreur)){
        echo  $erreur;
    }
    ?>
</body>
</html>



