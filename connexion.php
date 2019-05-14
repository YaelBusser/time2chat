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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
	<div class="bandehaut z1">
				<div class="flex">

					<h1 class="ombre1 police1 aligntitre em"><a href="index.html" class="anoneh1">Time<span class="blue">2</span>Chat</a></h1>
					<div class="accueilspace"></div>
				
					<p class="police1 em1 menu"><a href="index.html" class="anone blanc">Accueil</a></p>
					<div class="espace"></div>
					 <form class="menu3 em1" action="search.php" method="GET">
					   	 <input type="text" name="pseudo_recherche" style="width: 9vw; height: 0.8vw;">  
					   	 <input type="image" name="rechercher" src="images/search.png"  style="margin-left: -1vw; margin-bottom: -0.1vw; width: 0.8vw; height: 0.8vw;">
				   	</form>

					<div class="space1"></div>

							<p class="police1 em1 menu"><a href="connexion.php" class="anone blanc">Se connecter</a></p>
							<div class="space2"></div>

							<p class="police1 em1 menu"><a href="inscription.php" class="anone blanc">Inscription</a></p>
				</div>	
	</div>
	<br><br><br><br><br><br><br><br>
	<h1 class="centre police1 ombre" style="color: white;">Connexion</h1>
	<form method="POST" action="" name="connexion">
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
<script type="text/javascript">
	document.connexion.pseudoconnect.focus();
</script>
</body>
</html>