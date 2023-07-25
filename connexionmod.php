<?php
function validerDonneesConnexion($mail, $mdp) {
    // Effectuer les validations nécessaires sur les données de connexion
    if (empty($mail) || empty($mdp)) {
        return false;
    }

    return true;
}

function authentifierUtilisateur($mail, $mdp) {
    // Authentifier l'utilisateur dans la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=to do', 'root', '');
    
    $requser = $bdd->prepare("SELECT * FROM user WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mail, $mdp));
    $userexist = $requser->rowCount();
    
    if ($userexist == 1) {
        $userinfo = $requser->fetch();
        return [
            'success' => true,
            'id' => $userinfo['id'],
            'username' => $userinfo['username'],
            'mail' => $userinfo['mail']
        ];
    } else {
        return [
            'success' => false,
            'message' => "Mauvais mail ou mot de passe"
        ];
    }
}
?>


