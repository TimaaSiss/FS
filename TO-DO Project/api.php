<?php
require_once 'user.php';
require_once 'tache.php'; 
require_once 'database.php'; 

// Créez une instance de la classe Database pour la connexion à la base de données
$db = new Database('localhost', 'to do', 'root', '');
$pdo = $db->connect();

// Créez une instance de la classe User pour gérer les utilisateurs
$userManager = new User($pdo);

// Récupérez toutes les informations des utilisateurs
$users = $userManager->getAllUsers();

// Créez une instance de la classe Task pour gérer les tâches
$taskManager = new Task($pdo);

// Récupérez toutes les tâches
$taches = $taskManager->getAllTasks();

// Fusionnez les tableaux $users et $taches en un seul tableau
$response = array(
    'users' => $users,
    'taches' => $taches
);

// Renvoyez le tableau complet sous forme de réponse JSON
header("Content-Type: application/json");
echo json_encode($response, JSON_PRETTY_PRINT);
?>
