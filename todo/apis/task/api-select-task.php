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

        // Récupérer l'ID de la tâche depuis le corps de la requête POST
        $taskId = $_GET['id'];

        // Appeler la méthode getTacheById pour récupérer la tâche spécifique
        $tache = $taskManager->getTaskById($taskId);

        // Renvoyer une réponse JSON appropriée
        if ($tache) {
            echo json_encode($tache);
        } else {
            echo json_encode(['message' => 'Tâche non trouvée.']);
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>