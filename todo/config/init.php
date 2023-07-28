<?php
require_once 'database.php';
require_once 'user.php';
require_once 'tache.php';

// Établir une connexion à la base de données
$database = new Database('localhost', 'to do', 'root', '');
$database->connect();
$bdd = $database->getPDO();
$userManager = new User($bdd);
$taskManager = new Task($bdd);

define("SECRET_KEY","ABCDEFG123456");
