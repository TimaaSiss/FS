<?php
require_once '../../config/init.php';


// Récupérez les données du client (exemple : en utilisant $_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $dateLimite = $_POST['date_limite'];

    // Valider les données du formulaire (exemples de validations)
    if (empty($nom) || empty($description) || empty($dateLimite)) {
        echo json_encode(['message' => 'Veuillez remplir tous les champs obligatoires.']);
        exit; // Arrêter l'exécution du script
    } else {
        // Appeler la méthode createTache pour créer la tâche
        $success = $taskManager->createTask($nom, $description, $dateLimite);

        // Renvoyer une réponse JSON appropriée
        if ($success) {
            echo json_encode(['message' => 'Tâche créée avec succès.']);
        } else {
            echo json_encode(['message' => 'Échec de la création de la tâche.']);
        }
    }
}
?>
