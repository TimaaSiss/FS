<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=tpirt2', 'root', '');

if (isset($_POST['formdeconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($mailconnect) && !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();

        if ($userexist == 1) {
            $_SESSION = array();
            session_destroy();
            header("Location: connexion.php");
            exit();
        } else {
            $erreur = "Mauvais mail ou mot de passe";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés!";
    }
}
?>

<html>
<head>
    <title>Déconnexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Déconnexion</h2>
        <label>Mail:</label> <input type="email" name="mailconnect" placeholder="Mail"><br>
        <label>Mot de passe:</label> <input type="password" name="mdpconnect" placeholder="Mot de passe"><br>
        <input type="submit" name="formdeconnexion" value="Se déconnecter"><br>
    </form>
    
    <?php 
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>
</body>
</html>
