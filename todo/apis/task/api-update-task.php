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
        JWT::decode($jwt, new Key(SECRET_KEY, 'HS256'));

        // Le JWT est valide, on peut continuer

        
          // Récupérer les données du formulaire
            $taskId = $_POST['id'];
            $task_name = $_POST['task_name'];
            $status='';
            if( isset($_POST['status'])){
                 $status = $_POST['status'];
            }
  
          // Valider l'ID de la tâche
          if (empty($taskId) || empty($task_name)) {
              echo json_encode(['message' => 'Veuillez remplir les champs obligatoires.']);
              exit; // Arrêter l'exécution du script
          } else {
              // Appeler la méthode updateTache pour mettre à jour la tâche
            $success = $taskManager->updateTaskName($taskId, $task_name,$status);
              // Renvoyer une réponse JSON appropriée
              if ($success) {
                  echo json_encode(['message' => 'Tâche modifiée avec succès.']);
              }
               else {
                  echo json_encode(['message' => 'Échec de la modification de la tâche.']);
              }
          }
    }
    catch(ExpiredException$e){
        // Le JWT est expiré
        echo json_encode(['message' => 'Accès non autorisé. Token expired.']);
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}
