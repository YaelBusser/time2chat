<?php
session_start();

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ? ");
		$requete_utilisateur -> execute(array($getid));
		$info_utilisateur = $requete_utilisateur -> fetch();
	}
		
	if(!empty($_GET['terme']))
	{
		$getterme = intval($_GET['terme']);
		$requete_utilisateur_terme = $bdd -> prepare("SELECT * FROM bdr WHERE terme = ? ");
		$requete_utilisateur_terme -> execute(array($getterme));
		$info_terme = $requete_utilisateur_terme -> fetch();

		$requete_terme = $bdd -> prepare("SELECT * FROM bdr WHERE terme = ?");
		$requetemail_terme -> execute(array($terme));
		$terme_exist = $requete_terme -> rowCount();
		if($terme_exist == 1)
		{

		}
		else
		{
			$erreur = "Aucun utilisateur ne porte ce pseudo !";
		}
	}

	else
	{
		$erreur = "Vous n'avez pas entrer de pseudo !";		
	}

	?>
<html>

<head>
	<title>Time2Chat</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>

<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div class="flex">
		<p class="police1 btnlog vw1dot3 marginflex"><a href="deconnexion.php" class="anone">Se déconnecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>">Accueil</a></li>
				<li><a href="profil.php?id=<?php echo $_SESSION['id']; ?>">Profil</a></li>
				<li><a href="">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<div class="flex">
	<h1 class="vw10 bleufonce ombre police1 aligntitre"><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
</div>
	<div align="center">
	<?php

	if(isset($erreur))
	{
		echo '<p style="color: white;" class="ombre police1">'.$erreur.'</p>';
	}

	?>
</div>
	<div align="center">
   <form action = "recherche.php" method = "get" align="center">
   <input type = "search" name = "terme" style="width: 15vw; font-size: 2vw;">
   <input type = "submit" name = "s" value = "Rechercher" style="font-size: 2vw;">
  </form>
</div>
	

</body>
</html>