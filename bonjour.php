<!DOCTYPE html>
<html>
<head> 
	<title>la page bonjour</title>
</head>
<body>
	<?php

	if (isset($_GET["prenom"]) AND isset($_GET["nom"]) AND isset($_GET["classe"])){
		echo "Bonjour madame".$_GET["prenom"]." ".$_GET["nom"]."et vous etes en classe d' ".$_GET["classe"];

	}else
	 echo "Il faut renseigner les variables";

	?>