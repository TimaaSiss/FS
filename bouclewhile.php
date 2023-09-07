<!DOCTYPE html>
<html>
<head> 
	<title>Boucle While</title>
</head>
<body>
	<?php
	for ($nombre_de_lignes=1; $nombre_de_lignes <=100; $nombre_de_lignes++)
	{
	echo 'Ceci est la ligne n'. $nombre_de_lignes. '<br/>';
	for( $j=1; $j<$nombre_de_lignes; $j++)
	{
     echo "la variable j vaut". $j. "<br/>";

	}
	}
    ?>
  </body>
</html>