<!DOCTYPE html>
<html>
<head> 
	<title>La page cible</title>  
		
</head>
<body>
	<p>on va dire bonjour a notre nouvel utilisateur</p>
	<?php
	//var_dump($_POST);
	echo "<br/>" . "Merci pour votre visite Monsieur " .$_POST["prenom"]. " et votre mot de passe est: " .$_POST["mdp"];
	?>





