<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion BD</title>
</head>
<body>
	<?php
	$nomU=$_POST['username'];
	$motdepasse=$_POST['mdp'];
	 try{
	   $bd= new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root','');
	}
	catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
	$reponse=$bd->query('SELECT * FROM irt2');
	while ($donnee=$reponse->fetch()){

	 if($nomU==$donnee['username'] AND $motdepasse==$donnee['password']){
	 	echo "Vous etes bien authentifié!";
	 }
}