<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Récupérez les données du client (exemple : en utilisant $_POST pour une requête POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ?? '';

    // Vérifier si le JWT est valide
    $secretKey = 'ABCDEFG123456'; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT

    try {
        JWT::decode($jwt, $secretKey);

        // Le JWT est valide, on peut continuer

        // Récupérer l'ID de l'utilisateur depuis le formulaire
        $userId = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['mail'];
        $password = $_POST['password'];

        // Valider les données du formulaire (exemples de validations)
        if (empty($userId) || empty($username) || empty($email)) {
            echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
            exit; // Arrêter l'exécution du script
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['message' => 'Adresse e-mail invalide.']);
            exit; // Arrêter l'exécution du script
        } else {
            // Appeler la méthode updateUser pour mettre à jour l'utilisateur
            $success = $userManager->updateUser($userId, $username, $email, $password);

            // Renvoyer une réponse JSON appropriée
            if ($success) {
                echo json_encode(['message' => 'Utilisateur mis à jour avec succès.']);
            } else {
                echo json_encode(['message' => 'Échec de la mise à jour de l\'utilisateur.']);
            }
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}

?>
