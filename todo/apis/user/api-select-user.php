<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ?? '';

    // Vérifier si le JWT est valide et s'il contient les informations nécessaires
    $secretKey = 'ABCDEFG123456'; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT

    try {
        $decoded = JWT::decode($jwt, $secretKey);
        $userId = $decoded->user_id;

        // Appeler la méthode getTacheById pour récupérer la tâche spécifique
        $user = $userManager->getUserbyId($userId);

        // Renvoyer une réponse JSON appropriée
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['message' => 'Utilisateur non trouvé.']);
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>