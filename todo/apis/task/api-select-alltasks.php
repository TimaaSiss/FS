<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Récupérez les données du client (exemple : en utilisant $_GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ?? '';

    // Vérifier si le JWT est valide
    $secretKey = 'ABCDEFG123456'; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT

    try {
        JWT::decode($jwt, $secretKey);

        // Le JWT est valide, on peut continuer

        // Appeler la méthode getAllTasks pour récupérer toutes les tâches de l'application
        $tasks = $taskManager->getAllTasks();

        // Renvoyer une réponse JSON appropriée
        if ($tasks) {
            echo json_encode($tasks);
        } else {
            echo json_encode(['message' => 'Aucune tâche trouvée dans l\'application.']);
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}

?>