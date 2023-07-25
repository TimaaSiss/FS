<?php
require_once 'category.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_categorie'])) {
    $nom_categorie = $_POST['nom_categorie'];

    $categoryManager = new Category();
    $categoryManager->addCategory($nom_categorie);

    // Rediriger vers la page de gestion des catégories après l'ajout
    header("Location: categories.php");
    exit();
}
?>
