<?php
session_start();

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=","","");

if (isset($_GET['s']) AND $_GET['s'] == "Rechercher")
{
 $_GET['terme'] = htmlspecialchars($_GET['terme']); //pour sécuriser le formulaire contre les failles html
 $terme = $_GET['terme'];
 $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
 $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
}
?>
