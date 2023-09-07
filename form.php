<!DOCTYPE html>
<html>
<head> 
	<title>Mon site web</title>

     <style>
     	label{
     		width: 20%;
     		display: inline-block;
     		text-align: left;
          }
        body{
        	width: 50%;
        	font-family: arial;
        	margin: 5px auto;
        	background: #f4f7f8;
            padding: 20px;
            color: pink;
        }

    fieldset{
    border-radius: 8px;
    }
    legend{
    	font-size: 1.4em;
    	margin-bottom: 10px;
    }
    input[ type="text"],input[ type="number"], input[ type="email"]{
    	border-radius : 5px;
    	padding: 10px;
    	width: 70%;
    	background-coloe: white;
    }
    input[ type="submit"]{
    	position: relative;
    	padding: 20px;
    	font-size: 18px;
    	border: 1px solid grey;
    	border-radius: 2px;
    	margin: 10px;
    	width: 100%;
    }
    ul{
    	list-style-type: none;
    	padding: 20px;
    	overflow: hidden;
    	margin: 10px;
    	background-color: white;
    }
    li{
    	display: inline;
    	padding: 10px;
    	margin: 20px;
    }
    li a {
    	color: black;
    	padding: 20px;
    	margin: 20px;
    }
	</style>
</head>
<body>
	<?php
     $user="root";
     $mdp="";
     $db="projet";
     $server="localhost";
     $link=mysqli_connect($server,$user,$mdp,$db);
     if($link){
     	echo "connexion établie";
     }else
     {
     	die(mysqli_connect_error());
     }
	?>
	<header>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">News</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</nav>
	</header>

	<form method="post" action="">
		<fieldset>
			<legend>inscription</legend>
		<p><label>Nom:</label><input type="text" name="pseudo"/><br><br>
		  <label> Prenom:</label><input type="text" name="password"/><br><br>
		   <label>Telephone:</label><input type="number" name="password"/><br><br>
		   <label>Email:</label><input type="email" name="password"/><br><br>
		   <label>Sexe:</label><input type="radio" name="frites" id="frites" /> 
<label for="frites">homme</label> 
 <input type="radio" name="steak" id="steak" /> 
<label for="steak">femme</label><br /><br>


           <input type="submit" name="Valider"/>
		</p>
		</fieldset>
	</form>