
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="stylee.css">
    <style>
        .image-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .humanitarian-image {
            flex: 1;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur notre Espace membre à AIDE HUMANITAIRE</h1>
        <div class="welcome-message">
            <p>Merci de vous être inscrit. Vous pouvez maintenant profiter de tous les avantages réservés aux membres.</p>
        </div>

        <!-- Ajoutez cette partie pour vérifier la connexion et afficher le lien du profil -->
        <?php
        session_start();
        if (isset($_SESSION['id'])) {
            echo '<div class="user-info">';
            echo '<p>Bonjour, ' . $_SESSION['pseudo'] . ' !</p>';
            echo '<a href="profil.php">Accéder à mon profil</a>';
            echo '</div>';
        } else {
            echo '<p>Veuillez vous connecter pour accéder à votre profil.</p>';
        }
        ?>

        <a href="profil.php">Se connecter</a> 

        <!-- Ajoutez le reste de votre contenu de la page d'accueil -->
    </div> <br/>
    <br/>

        <div class="image-container">
            <div class="humanitarian-image">
                <img src="puit.jpg" alt="Image 1">
                <p> L'eau n'est elle pas importante pour tout un chacun sous tous ses aspects? <br/><br/>Contribuez à aider un village entier en donnant un don ou quoi que ce soit qui puisse etre utile a creuser un puit.<br/></p>
            </div>
            <div class="humanitarian-image">
                <img src="habit.jpg" alt="Image 2">
                <p>De pauvres refugier qui n'ont ni ou vivres ni vetements adequat pour au moins etre au chaud en cas de plus ou de froid. Votre don de vetements pour ses petits et grands sera une pluie de bénédiction pour vous. N'hésitez pas!!</p>
            </div>
            <div class="humanitarian-image">
                <img src="charite.jpg" alt="Image 3">
                <p>La charité est l'une des meilleures actions qu'un individus puisse effectuer pour son prochain et l'esprit de partage est juste magnifique participez y. Voir les autres heureux est un plaisir inconmensurable!</p>
            </div>
        </div>

    
</body>
</html>




