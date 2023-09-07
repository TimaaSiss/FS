<?php
session_start();

// Tableau des utilisateurs
$users = array(
array('username' => 'Tima', 'password' => 'Timaa', 'secret_code' => 'Tima1'),
array('username' => 'Assi', 'password' => 'Assii', 'secret_code' => 'Assi2')
);

// Vérification de l'authentification ou récupération de mot de passe
if (isset($_POST['username'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$secret_code = $_POST['secret_code'];

// Recherche de l'utilisateur
$user = null;
foreach ($users as $u) {
if ($u['username'] === $username) {
$user = $u;
break;
}
}

if (!$user) {
$error = 'Nom d\'utilisateur incorrect.';
} else if ($password !== $user['password'] && $secret_code !== $user['secret_code']) {
$error = 'Mot de passe et code secret incorrects.';
} else if ($password !== $user['password'] && $secret_code === $user['secret_code']) {
// Rediriger vers une page de récupération de mot de passe
header('Location: recuperation.php');
exit;
} else {
$_SESSION['username'] = $username;
header('Location: recuperation.php');
exit;
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF8"/>
<link rel="stylesheet" href="style.css"/>

<title>TP</title>

</head>
<body class="SARAN">
<h1 > BIENVENUE SUR NOTRE FORMULAIRE</h1>

<form method="POST" action="notresite.php">
<div class="contair">
<h2>Veuillez vous authentifier</h2>
		<table class="adja">
		<tr>
				<th>Champ</th>
				<th>Valeur</th>
			</tr>
			<tr>
				<td>USERNAME:</td>
				<td><input type="text" name="nom"></td>
			</tr>
			
			<tr>

			<tr>
				<td>PASSWORD:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Se connecter"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="alert" value="Mot de passe oublié ?"></td>
			</tr>
		</table>
	</div>
	</form>

