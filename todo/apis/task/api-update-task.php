<?php
require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Vérifier si le JWT est présent dans l'en-tête Authorization
    $headers = apache_request_headers();
    $jwt = $headers['Authorization'] ?? '';

    // Vérifier si le JWT est valide
    $secretKey = 'ABCDEFG123456'; // Assurez-vous d'utiliser la même clé secrète que celle utilisée lors de la création du JWT

    try {
        JWT::decode($jwt, $secretKey);

        // Le JWT est valide, on peut continuer

        // Récupérer l'ID de la tâche à mettre à jour depuis l'URL (ex: /tasks/1)
        $taskId = $_GET['id'];

        // Récupérer les nouvelles données de la tâche depuis le corps de la requête PUT
        parse_str(file_get_contents("php://input"), $newData);
        $nom = $newData['nom'];
        $description = $newData['description'];
        $dateLimite = $newData['date_limite'];

        // Valider les données du formulaire (exemples de validations)
        if (empty($nom) || empty($description) || empty($dateLimite)) {
            echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
            exit; // Arrêter l'exécution du script
        } else {
            // Appeler la méthode updateTache pour mettre à jour la tâche
            $success = $taskManager->updateTaskName($taskId, $taskName);

            // Renvoyer une réponse JSON appropriée
            if ($success) {
                echo json_encode(['message' => 'Tâche mise à jour avec succès.']);
            } else {
                echo json_encode(['message' => 'Échec de la mise à jour de la tâche.']);
            }
        }
    } catch (Exception $e) {
        // Le JWT n'est pas valide ou est expiré
        echo json_encode(['message' => 'Accès non autorisé.']);
    }
}

?>
