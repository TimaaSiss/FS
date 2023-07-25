<!DOCTYPE html>
<html>
<head> 
	<title>les variables en PHP</title>
</head>
<body>
	<?php
	$age_du_visiteur=17;
	echo $age_du_visiteur;
	echo "<br/>";
	$age_du_visiteur=true;
	echo $age_du_visiteur;
	echo "<br>";
	$age_du_visiteur1="Nous sommes en IRT2";
	echo $age_du_visiteur;
	echo "<br>";
	$nom_du_visiteur="Je suis \"Fatoumata Sissoko\"";
	echo $nom_du_visiteur;
	echo "<br>";
	$nom_du_visiteur="je m'appelle 'Tima'";
	echo $nom_du_visiteur;
	echo "<br>";
	echo "où sommes nous? <br> $age_du_visiteur1";
	echo "<br>";
	echo 'où sommes nous? <br> $age_du_visiteur1 <br> ';
    echo $age_du_visiteur1;

    function mafonction(){
    	global $age_du_visiteur1, $nom_du_visiteur;
    	$testfonction=18.9;
    	echo $age_du_visiteur1. "<br>";
    	echo $nom_du_visiteur. "<br>";
    	echo $testfonction;
    }
    mafonction();
	?>
	/html>
	 
</body>
	<