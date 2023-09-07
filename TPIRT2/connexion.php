<!-- connexionView.php -->
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="POST" action="controllerconnexion.php">
        <h2>Connexion</h2>
        <label>Mail:</label> <input type="email" name="mailconnect" placeholder="Mail"><br>
        <label>Mot de passe:</label> <input type="password" name="mdpconnect" placeholder="Mot de passe"><br>
        <input type="submit" name="formconnect" value="Se connecter"><br>
    </form>
    
    <?php 
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>
</body>
</html>



