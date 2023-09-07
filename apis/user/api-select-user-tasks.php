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
        $decoded = JWT::decode($jwt, new Key(SECRET_KEY,'HS256'));
        $userId = $decoded->user_id;

        // // Récupérer l'ID de l'utilisateur depuis l'URL (ex: /users/1/tasks)
        // $userIdFromRequest = $_POST['user_id'];

        // // Vérifier si l'ID de l'utilisateur dans le JWT correspond à celui dans la requête
        // if ($userIdFromRequest !== $userId) {
        //     echo json_encode(['message' => 'Accès non autorisé.']);
        //     exit; // Arrêter l'exécution du script
        // }

        // Appeler la méthode getTasks pour récupérer les tâches de l'utilisateur spécifié
        // $tasks = $tacheManager->getTasks($userId);
        $tasks = $taskManager->getTasks($userId);


        // Renvoyer une réponse JSON appropriée
        if ($tasks) {
            echo json_encode(["status"=>200,"todos"=>$tasks]);
        } else {
            echo json_encode(['message' => 'Aucune tâche trouvée pour cet utilisateur.']);
        }
    } catch (ExpiredException $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Token expired.']);
    }catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}else{
    echo json_encode(['message' => 'Method not authorized.']);

}
?>