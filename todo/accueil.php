<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fd6c9e;
            text-decoration: none;
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .menu li {
            display: inline-block;
            margin-right: 10px;
        }

        .menu li a {
            text-decoration: none;
            color: #666;
        }

        .menu li a:hover {
            color: #333;
        }

        .task-list {
            margin-top: 30px;
            list-style-type: none;
            padding: 0;
        }

        .task-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-item .checkbox {
            margin-right: 10px;
        }

        .task-item .task-name {
            flex-grow: 1;
            color: #333;
        }

        .task-item .task-actions {
            margin-left: 10px;
        }

        .task-item .task-actions a {
            text-decoration: none;
            color: #666;
            margin-right: 5px;
        }

        .task-item .task-actions a:hover {
            color: #333;
        }

        .add-task-form {
            margin-top: 30px;
            display: flex;
        }

        .add-task-form input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }

        .add-task-form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #4caf50;
            color: #fff;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        .add-task-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .feature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .feature {
            flex: 1;
            margin: 0 10px;
        }

        .feature img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .feature p {
            margin-top: 10px;
        }
    </style>
</head>
     <?php
require_once './config/database.php';
require_once './config/user.php';
require_once './config/tache.php';

// Établir une connexion à la base de données
$database = new Database('localhost', 'to do', 'root', '');
$database->connect();
$bdd = $database->getPDO();
?>

<body>

    <div class="container">
        <div class="header">
            <a class="logo" href="#">My To-Do List</a>
            <ul class="menu">
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            </ul>
        </div>



        <p>Sur ce site, vous trouverez tous les outils nécessaires pour bien gérer et organiser vos tâches de la manière la plus facile et la plus convenabl possible.</p>
     </div>

      <div>

        <div class="feature-container">
            <div class="feature">
                <img src="./assets/projet.png" alt="Image 1">
                <p>Vous avez un projet d'équipe à gérer et vous êtes chargé en ne sachant pas comment vous organiser ?<br/>Ne vous en faites pas, notre site web est là pour vous!<br/></p>
            </div>
            <div class="feature">
                <img src="./assets/work.jpg" alt="Image 2">
                <p>Avec ma to do list, peu importe le mombre de taches,n'ayez crainte nous pourrez faire un check de toutes les taches et les notes egalement pour eviter de vous perdre. </p>
            </div>
            <div class="feature">
                <img src="./assets/task.webp" alt="Image 3">
                <p>Nous vous offrons un profil bien amenager et organiser qui vous permettra de noter vos taches de la plus importantes a la moins importantes, de la plus compliquer a la moins difficiles et ainsi de suite. Finit les prises de tete pour gerer a bien toutes vos taches :)</p>
            </div>
        </div>

    </div>
</body>
</html>



       




