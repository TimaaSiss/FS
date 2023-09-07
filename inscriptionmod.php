<?php
function validerDonneesInscription($pseudo, $email, $motdepasse, $motdepasse2) {
    // Effectuer les validations nécessaires sur les données d'inscription
    if (empty($pseudo) || empty($email) || empty($motdepasse) || empty($motdepasse2)) {
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if ($motdepasse !== $motdepasse2) {
        return false;
    }

    return true;
}

function inscriptionUtilisateur($pseudo, $email, $motdepasse) {
    // Effectuer l'inscription de l'utilisateur dans la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=to do', 'root', '');
    
    $reqmail = $bdd->prepare("SELECT * FROM user WHERE mail = ?");
    $reqmail->execute(array($email));
    $emailexist = $reqmail->rowCount();
    
    if ($emailexist == 0) {
        $insertmbr = $bdd->prepare("INSERT INTO user(username, mail, password, dateinscription) VALUES(?,?,?, NOW())");
        return $insertmbr->execute(array($pseudo, $email, $motdepasse));
    }

    return false;
}
?>
