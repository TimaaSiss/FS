<?php
require_once '../../config/init.php';

// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['motdepasse'];
    
    // Valider les données du formulaire (exemples de validations)
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
        exit; // Arrêter l'exécution du script
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['message' => 'Adresse e-mail invalide.']);
        exit; // Arrêter l'exécution du script
    } else {
        // Hasher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Appeler la méthode createUser pour effectuer l'inscription
        $success = $userManager->createUser($username, $email, $hashed_password);

        // Renvoyer une réponse JSON appropriée
        if ($success) {
            echo json_encode(['message' => 'Utilisateur créé avec succès.']);
        } else {
            echo json_encode(['message' => 'Échec de la création de l\'utilisateur.']);
        }
    }
}
?>


