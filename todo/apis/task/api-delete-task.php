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
  
          // Le JWT est valide, on peut continuer
  
          // Récupérer les données du formulaire
          $taskId = $_POST['id'];

        
          
  
          // Valider l'ID de la tâche
          if (empty($taskId)) {
              echo json_encode(['message' => 'Veuillez fournir l\'identifiant de la tâche à supprimer.']);
              exit; // Arrêter l'exécution du script
          } else {
              // Appeler la méthode deleteTask pour supprimer la tâche
              $success = $taskManager->deleteTask($taskId);
  
              // Renvoyer une réponse JSON appropriée
              if ($success) {
                  echo json_encode(['message' => 'Tâche supprimée avec succès.']);
              }
               else {
                  echo json_encode(['message' => 'Échec de la suppression de la tâche.']);
              }
          }
          
      } catch (Exception $e) {
          // Le JWT est expiré
          echo json_encode(['message' => 'Accès non autorisé. Token Expired']);
      }catch(ExpiredException $e){
        // Le JWT n'est pas valide ou est expiré
          echo json_encode(['message' => 'Accès non autorisé.']);
    

      }
  }
  
?>