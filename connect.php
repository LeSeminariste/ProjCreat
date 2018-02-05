<?php
$host = "localhost";
$username="root";
$password="";
$database="test";

$connexion = mysqli_connect($host,$username,$password)
       or die("Connexion impossible au serveur $host avec l'usager $username");

mysqli_select_db ($connexion, $database)
    or die ("la base de donnée: $database n'existe pas".mysqli_error());
	
try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch (Exception $e)
{
		die('Erreur : ' . $e->getMessage());
}
?>