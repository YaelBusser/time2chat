<?php
session_start();

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");

	if(isset($_POST['formconnect']))
	{
		$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if(!empty($pseudoconnect) AND !empty($mdpconnect))
		{
			$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE pseudo= ? AND mdp = ?");
			$requete_utilisateur -> execute(array($pseudoconnect, $mdpconnect));
			$utilisateur_exist = $requete_utilisateur -> rowCount();
			if($utilisateur_exist == 1)
			{
				$info_utilisateur = $requete_utilisateur -> fetch();
				$_SESSION['id'] = $info_utilisateur['id'];
				$_SESSION['pseudo'] = $info_utilisateur['pseudo'];
				$_SESSION['mail'] = $info_utilisateur['mail'];
				$_SESSION['mdp'] = $info_utilisateur['mdp'];
				header("Location: profil.php?id=".$_SESSION['id']."");
			}
			else
			{
				$erreur = '<p style="color: white;" class="ombre police1">Le pseudo ou le mot de passe est incorrect !</p>';
			}
		}
		else
		{
			$erreur = '<p style="color: white;" class="ombre police1">Tous les champs doivent être complétés !</p>';
		}
	}

?>

<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>
<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="index.html" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div class="flex">
		<p class="police1 btnlog vw1dot3 marginlog"><a href="inscription.php" class="anone">Inscription</a></p>
		<p class="police1 btnlog vw1dot3 marginflex"><a href="connexion.php" class="anone">Se connecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="index.html">Accueil</a></li>
				<li><a href="chat.php">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<h1 class="centre police1 ombre" style="color: white;">Connexion</h1>
	<form method="POST" action="">
		<div align="center">
		<table>
			<tr>
				<td><input type="text" name="pseudoconnect" placeholder="Votre Pseudo" autocomplete="off" value="<?php if(isset($pseudoconnect)){ echo $pseudoconnect ;} ?>"></td>
			<tr>
				<td><input type="password" name="mdpconnect" placeholder="Votre Mot De Passe" autocomplete="off"></td>
			</tr>

			<tr>
				<td align="center"><br><input type="submit" name="formconnect" value="Se connecter"></td>
			</tr>
		</table>
		<br>
		<div align="center">
		<?php

		if(isset($erreur))
		{
			echo $erreur;
		}

		?>
	</div>
	</form>
</div>
</body>
</html>