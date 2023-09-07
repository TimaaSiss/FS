<?php

function inscription($pseudo, $email, $motdepasse)
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpirt2', 'root', '');


    $reqmail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
    $reqmail->execute(array($email));
    $emailexist = $reqmail->rowCount();

    if ($emailexist == 0) {
        $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, email, password, dateinscription) VALUES(?,?,?, NOW())");
        $insertmbr->execute(array($pseudo, $email, $motdepasse));
        return true; // Inscription réussie
    } else {
        return false; // Adresse email déjà utilisée
    }
}


