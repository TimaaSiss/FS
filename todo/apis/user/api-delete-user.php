<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';


    try {
        $decodedJWT = JWT::decode($jwt, new Key(SECRET_KEY,'HS256'));
        $userRoles = $decodedJWT->roles;

        // Vérifier si l'utilisateur a le rôle "admin"
        if ($userRoles=='admin') {
            // L'utilisateur est un administrateur, on peut continuer

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
        } else {
            echo json_encode(['message' => 'Accès non autorisé.']);
        }
    } catch (ExpiredException $e) {
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé Token Expired.']);
    }catch(Exception $e){
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>
