<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérez les données du client (exemple : en utilisant $_POST pour une requête POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';

    try {
        $decodedJWT = JWT::decode($jwt, new Key(SECRET_KEY,'HS256'));
        $userRoles = $decodedJWT->roles;

        // Le JWT est valide, on peut continuer

        // Récupérer l'ID de l'utilisateur depuis le formulaire
        $userId = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['mail'];
        if( isset($password)){
        $password = $_POST['password'];
        }
        $userRoles = $decodedJWT->roles;
        // Vérifier si l'utilisateur a le rôle "admin"
        if ($userRoles=='admin') {

            // Valider les données du formulaire (exemples de validations)
        if (empty($userId) || empty($username) || empty($email)) {
            echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
            exit; // Arrêter l'exécution du script
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['message' => 'Adresse e-mail invalide.']);
            exit; // Arrêter l'exécution du script
        } else {
            // Appeler la méthode updateUser pour mettre à jour l'utilisateur
            $success = $userManager->updateUser($userId, $username, $email);

            // Renvoyer une réponse JSON appropriée
            if ($success) {
                echo json_encode(['message' => 'Utilisateur mis à jour avec succès.']);
            } else {
                echo json_encode(['message' => 'Échec de la mise à jour de l\'utilisateur.']);
            }
        }
           
        } else {
            echo json_encode(['message' => 'Accès non autorisé.']);
        }

        
    } catch (ExpiredException $e) {
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé Token Expired.']);
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
