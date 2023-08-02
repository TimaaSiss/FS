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
        JWT::decode($jwt,  new Key(SECRET_KEY, 'HS256'));
        // Le JWT est valide, on peut continuer

        // Récupérer l'ID de la tâche depuis le corps de la requête POST
        $taskId = $_GET['id'];

          // Valider l'ID de l'utilisateur
          if (empty($taskId)) {
            echo json_encode(['message' => 'Veuillez fournir l\'identifiant de la tache à séléctionner.']);
            exit; // Arrêter l'exécution du script
        }

        // Appeler la méthode getTacheById pour récupérer la tâche spécifique
        $tache = $taskManager->getTaskById($taskId);

        // Renvoyer une réponse JSON appropriée
        if ($tache) {
            echo json_encode($tache);
        } else {
            echo json_encode(['message' => 'Tâche non trouvée.']);
        }
    }catch(ExpiredException $e){
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé. Token expired.']);
    }
     catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
?>