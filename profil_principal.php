<?php
session_start();
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");
	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getpseudo = $_GET['pseudo'];
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE pseudo = ? ");
		$requete_utilisateur -> execute(array($getpseudo));
		$info_utilisateur = $requete_utilisateur -> fetch();
	
}

	

	
?>

<html>
<head>
	<title><?php echo 'Profil de '.$_GET['pseudo'].''; ?></title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>
<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div align="center">
		<p class="police1 btnlog vw1dot3 marginflex center"><a href="deconnexion.php" class="anone">Se déconnecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>">Accueil</a></li>
				<li><a href="profil.php?id=<?php echo $_SESSION['id']; ?>">Profil</a></li>
				<li><a href="chat.php">Discussion</a></li>
			</ul>
	</nav>
	</div>
	<h1 class="centre police1 ombre" style="color: white; font-size: 3vw; text-decoration: underline;">

	<img style="border-radius: 25%;" src="avatars/<?php  echo $_GET['avatar']; ?>" width="250" height="250">

	<span style="color: #66ccff; margin-left: 15%;"><?php echo $_GET['pseudo']; ?></span>

	</h1>


</body>
</html>