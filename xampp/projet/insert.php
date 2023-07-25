<?php
include"form.php";

if(isset($_GET["nom"]) && isset($_GET["prenom"]) && isset($_GET["phone"]) && isset($_GET["mail"]) && isset($_GET["gender"])){

	$nom= $_GET["nom"];
	$prenom= $_GET["prenom"];
	$phone= $_GET["phone"];
    $mail= $_GET["mail"];
    $_sexe= $_GET["gender"];

    $req= mysqli_query($link, " insert into user(nom,prenom,telephone,mail,sexe) values ('$nom','$prenom','$phone','$mail','$sexe'");

    if($req){
    	echo "insertion effectuée"

    }
    else{
    	echo "erreur d'insertion"
    }
}
?>