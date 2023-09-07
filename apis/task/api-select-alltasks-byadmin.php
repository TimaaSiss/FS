<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérez les données du client (exemple : en utilisant $_GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $data = json_decode(file_get_contents("php://input"), true);
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';

    try {
        $decoded = JWT::decode($jwt, new Key(SECRET_KEY, 'HS256'));
        $userRoles = $decoded->roles;
        $tasks = $taskManager->getAllTasks();

        
        // Vérifier si l'utilisateur a le rôle "admin"
        if ($userRoles=='admin') {
            // L'utilisateur est un administrateur, on peut continuer

            // Récupérer les données du formulaire
           // $userId = $_GET['id'];

            // Valider l'ID de l'utilisateur
          //  if (empty($tasks)) {
             //   echo json_encode(['message' => 'Veuillez fournir l\'identifiant de la tache à séléctionner.']);
             //   exit; // Arrêter l'exécution du script
          //  } else {
                // Appeler la méthode getTache pour récupérer la tâche spécifique
               // $tache = $taskManager->getAllTasks();

                // Renvoyer une réponse JSON appropriée
                if ($tasks) {
                    echo json_encode($tasks);
               // } //else {
                    echo json_encode(['message' => 'Utilisateur non trouvé.']);
                }
          //  }
        } else {
            echo json_encode(['message' => 'Accès non autorisé.']);
        }
        if ($tasks) {
            echo json_encode($tasks);
        } else {
            echo json_encode(['message' => 'Aucune tâche trouvée.']);
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
