<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérez les données du client (exemple : en utilisant $_POST pour une requête POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $data = json_decode(file_get_contents("php://input"), true);


    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';

    try {
        $decodedJWT = JWT::decode($jwt, new Key(SECRET_KEY,'HS256'));
        $userRoles = $decodedJWT->roles;

        // Le JWT est valide, on peut continuer

        // Récupérer l'ID de l'utilisateur depuis le formulaire
        if (isset($data['userId'])  && isset($data['username']) && isset($data['email'])) {
            $userId = $data['userId'];
            $username = $data['username'];
            $email = $data['email'];
            $password = $data['password'];
        } else {
            echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
            exit;
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
            $success = $userManager->updateUser($userId, $username, $email, $password);

            // Renvoyer une réponse JSON appropriée
            if ($success) {
                echo json_encode(['message' => 'Utilisateur mis à jour avec succès.', 'status'=>200, 'username'=>$username, 'email'=>$email, 'password'=>$password]);
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
