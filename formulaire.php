<!DOCTYPE html>
<html>
<head> 
	<title>LOGIN</title>  
		
</head>
<body>
	<form method="POST" action="cible.php">
		<label for="identifiant">Username</label><input type="text" name="prenom" id="identifiant"></br>
		<label for="mdp">Mot de Passe</label><input type="password" name="mdp" id="mdp"></br>
		<label for="choix">Classe</label><select name="choix" id="choix">

        <option value="IRT1">IRT1</option>
        <option value="IRT2">IRT2</option>
        <option value="IRT3">IRT3</option>
        <option value="ESEO">ESEO</option>

         </select><br/>
         <label for="bton">Valider</label><input type="submit" name="Valider" id="bton"><br/>
