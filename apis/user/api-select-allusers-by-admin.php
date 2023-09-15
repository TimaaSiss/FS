<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérez les données du client (exemple : en utilisant $_GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';

    try {
        $decoded = JWT::decode($jwt, new Key(SECRET_KEY, 'HS256'));
        $userRoles = $decoded->roles;
        $users = $userManager->getAllUsers();
        
        
        // Vérifier si l'utilisateur a le rôle "admin"
        if ($userRoles=='admin') {

                // Renvoyer une réponse JSON appropriée
                if ($users) {
                    echo json_encode(["status"=>200,"users"=>$users]);
                }else {
                    echo json_encode(['message' => 'Utilisateur non trouvé.']);
                }
          //  }
        } else {
            echo json_encode(['message' => 'Accès non autorisé.']);
        }
    } catch (ExpiredException $e) {
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé. Token Expired']);
    }catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>
