<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=tpirt2', 'root', '');

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $requser->execute(array($id));
    $userinfo = $requser->fetch();
?>

<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <style>
        body {
            background-color: #f5F5DC;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
        <br/> <br/>
        <p>Pseudo: <?php echo $userinfo['pseudo']; ?></p>
        <p>Email: <?php echo $userinfo['email']; ?></p>

        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</body>
</html>

<?php
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
?>
