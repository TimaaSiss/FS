<?php
  require_once '../../config/init.php';
  require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT
  
  use Firebase\JWT\JWT;
  
  // Récupérez les données du client (exemple : en utilisant $_POST)
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Vérifier si le JWT est présent dans l'en-tête Authorization
      $headers = apache_request_headers();
      $jwt = $headers['Authorization'] ?? '';
  
      // Vérifier si le JWT est valide
      $secretKey = 'ABCDEFG123456'; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT
  
      try {
          JWT::decode($jwt, $secretKey);
  
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
              } else {
                  echo json_encode(['message' => 'Échec de la suppression de la tâche.']);
              }
          }
      } catch (Exception $e) {
          // Le JWT n'est pas valide ou est expiré
          echo json_encode(['message' => 'Accès non autorisé.']);
      }
  }
  
?>