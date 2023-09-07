<?php

// ini_set("display_errors", 1);
// ini_set("display_startup_errors", 1);
// error_reporting(-1);


require_once '../../config/init.php';
require_once '../../vendor/autoload.php'; // Charge la bibliothèque JWT

use Firebase\JWT\JWT;

// Vérifiez si les données de connexion sont envoyées via une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $data = json_decode(file_get_contents("php://input"), true);


    $email = $data['mailconnect'];
    $password = $data['mdpconnect'];

    // Valider les données du formulaire (exemples de validations)
    if (empty($email) || empty($password)) {
        echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
        exit; // Arrêter l'exécution du script
    }

    // Vérifier les informations de connexion dans la base de données
    $userAuthenticated = $userManager->authenticateUser($email, $password);

    if ($userAuthenticated) {
        // Connexion réussie

        // Informations à inclure dans le JWT (vous pouvez personnaliser ces données)
        $user = $userManager->getUserbyEmail($email);
        $userId = $user['id'];
        $userRoles = $user['Roles'];

        // Temps d'expiration du JWT (facultatif)
        $issuat = time();
        $expirationTime = $issuat + 3600; // Expire dans 1 heure

        // Créez le JWT
        $payload = array(
            'iat' => $issuat,
            "user_id" => $userId,
            "roles" => $userRoles,
            "exp" => $expirationTime
        );

        $jwt = JWT::encode($payload, SECRET_KEY,'HS256');

        // Renvoyer le JWT dans la réponse JSON
        echo json_encode(['message' => 'Connexion réussie.',"status"=>200,"username"=>$user['username'],"email"=>$email,'jwt' => $jwt]);
    } else {
        // Échec de la connexion
        echo json_encode(['message' => 'Échec de la connexion.']);
    }
}
?>











