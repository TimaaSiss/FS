<!DOCTYPE html>
<html>
<head> 
	<title>condition en PHP</title>
</head>
<body>
	<?php
	$age=8;
	$langue="anglais";
	if($age<=12 AND $langue=="français")
	







		echo"Bienvenue sur notre site!";
    }
    elseif($age<=12 AND $langue=="anglais")
    {
    echo "Welcome to my website!";
    }
    $pays="Mali";
    if($pays=="Mali"OR $pays== "Burkina")
    {
    echo "Bienvenue sur notre site!";
    }
    else
    {
    echo "Desoles, notre service n'est pas encore disponible dans votre pays!";
    }
    ?>
