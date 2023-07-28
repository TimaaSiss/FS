<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ?? '';

    // Vérifier si le JWT est valide
    $secretKey = SECRET_KEY; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT

    try {
        JWT::decode($jwt, $secretKey);
        // Le JWT est valide, on peut continuer

        // Récupérer les données du formulaire
        $userId = $_POST['id'];

        // Valider l'ID de l'utilisateur
        if (empty($userId)) {
            echo json_encode(['message' => 'Veuillez fournir l\'identifiant de l\'utilisateur à supprimer.']);
            exit; // Arrêter l'exécution du script
        } else {
            // Appeler la méthode deleteUser pour supprimer l'utilisateur
            $success = $userManager->deleteUser($userId);

            // Renvoyer une réponse JSON appropriée
            if ($success) {
                echo json_encode(['message' => 'Utilisateur supprimé avec succès.']);
            } else {
                echo json_encode(['message' => 'Échec de la suppression de l\'utilisateur.']);
            }
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>