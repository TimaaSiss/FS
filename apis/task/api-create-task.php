<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Récupérer le token JWT envoyé dans l'en-tête de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // Vérifier si le JWT est présent dans l'en-tête Authorization
        $data = json_decode(file_get_contents("php://input"), true);
        $headers = apache_request_headers();
        $jwt = $headers['Authorization'] ? trim(substr($headers['Authorization'], 7)) : '';
    // Vérifier si le token JWT est présent et non vide

        // Décoder le JWT pour vérifier s'il est valide
        $decodedJWT =  JWT::decode($jwt, new Key (SECRET_KEY,'HS256'));

        // Vous pouvez accéder aux données du JWT comme ceci :
         $userId = $decodedJWT->user_id;
       
        // Maintenant, vous pouvez créer la tâche car l'autorisation est valide
       
            // Récupérer les données du formulaire
            $task_name = $data['task_name'];

            // Valider les données du formulaire (exemples de validations)
            if (empty($task_name)) {
                echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
                exit; // Arrêter l'exécution du script
            } else {
                // Appeler la méthode createTask pour créer la tâche
                $success = $taskManager->createTask($userId, $task_name);

                // Renvoyer une réponse JSON appropriée
                if ($success['status']==200) {
                    echo json_encode(['message' => 'Tâche créée avec succès.',"status"=>200,"todo"=>["id"=>$success['id'],"text"=>$task_name]]);
                } else {
                    echo json_encode(['message' => 'Échec de création de la tâche.']);
                }
            }
        
    }catch(ExpiredException $e){
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé. Token expired.']);
    } catch (Exception $e) {
        // Le JWT n'est pas valide
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
} ?>