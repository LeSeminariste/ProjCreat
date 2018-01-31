<?php
$host = "localhost";
$username="root";
$password="";
$database="test";

$connexion = mysqli_connect($host,$username,$password)
       or die("Connexion impossible au serveur $host avec l'usager $username");

mysqli_select_db ($connexion, $database)
    or die ("la base de donnée: $database n'existe pas".mysqli_error());
?>