<!DOCTYPE html>
<html>
<head> 
	<title>fonctions</title>
</head>
<body>
	<?php

 $coordonnees = array (
'prenom' => 'François',
'nom' => 'Dupont',
'adresse' => '3 Rue du Paradis',
'ville' => 'Marseille');
if (array_key_exists('nom', $coordonnees))
{
echo 'La clé "nom" se trouve dans les coordonnées !. <br />';
}else
{
echo ‘La clé"non"ne se trouve pas dans le tableau coordonnées’
}
if (array_key_exists('pays', $coordonnees))
{
echo 'La clé "pays" se trouve dans les coordonnées !';
} else
{
echo ‘La clé "pays"trouve pas dans le tableau coordonnées’
}
?>
