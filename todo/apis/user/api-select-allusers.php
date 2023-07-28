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
        JWT::decode($jwt, $secretKey,);

        // Le JWT est valide, on peut continuer

        // Appeler la méthode getAllUsers pour récupérer tous les utilisateurs de l'application
        $users = $userManager->getAllUsers();

        // Renvoyer une réponse JSON appropriée
        if ($users) {
            echo json_encode($users);
        } else {
            echo json_encode(['message' => 'Aucun utilisateur trouvé dans l\'application.']);
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>