<!DOCTYPE html>
<html>
<head> 
	<title>fonctions</title>
</head>
<body>
	<?php
		$ma_variable= str_replace('b','p', 'bim bam boum');
		echo $ma_variable;

		$alphabet= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvw,;!?@#%*`1234567890';
		$alphabet= str_shuffle($alphabet); 
		echo $alphabet;
		
        $jour=date('d');
        $mois=date('m');
        $annee=date('y');
        $heure=date('h');
        $minute=date('m');
        echo 'Bonjour! Nous sommes le '.$jour.  '/' . $mois . '/' .
$annee . 'et il est ' . $heure. ' h ' . $minute;



	?>