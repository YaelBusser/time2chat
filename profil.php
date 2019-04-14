<?php
session_start();
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=","","");
	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ? ");
		$requete_utilisateur -> execute(array($getid));
		$info_utilisateur = $requete_utilisateur -> fetch();
	}

	if(isset($_SESSION['id']) AND $info_utilisateur['id'] == $_SESSION['id'])
	{

	
?>

<html>
<head>
	<title><?php echo 'Profil de '.$info_utilisateur['pseudo'].''; ?></title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>
<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div align="center">
		<p class="police1 btnlog vw1dot3 marginflex center"><a href="deconnexion.php" class="anone">Se déconnecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>">Accueil</a></li>
				<li><a href="profil.php?id=<?php echo $info_utilisateur['id']; ?>">Profil</a></li>
				<li><a href="">Discussion</a></li>
			</ul>
	</nav>
	</div>
	<h1 class="centre police1" style="color: white; font-size: 3vw; text-decoration: underline;">Votre Profil :</h1>
	<div style="margin-left: 35%">
	<div style="display: flex;">
		<?php

		if(!empty($info_utilisateur['avatar']))
		{
		?>
		<img style="border: 5px solid red; border-radius: 50%;" src="avatars/<?php  echo $info_utilisateur['avatar']; ?>" width="150" height="150">
		<?php
		}

		?>
	<table>
		</tr>
		<tr>
			<td>
	<p><?php echo '<h1 style="color: white;" class="police1">Votre pseudo : '.$info_utilisateur['pseudo'].'</h1>'; ?></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><?php echo '<h1 style="color: white;" class="police1">Votre mail : '.$info_utilisateur['mail'].'</h1>'; ?></p>
		</td>		
	</tr>
	<tr>
		<td align="center">
			<h1 class="police1 ombre"><a href="editionprofil.php?id=<?php echo $info_utilisateur['id']; ?>" style="color: white;">Editez votre profil</a></h1>
		</td>
	</tr>
</table>
</div>
</div>

<?php
}
else
{
	echo '<h1 style="text-align: center;">Erreur dans l\'url !</h1>';
}
?>
</body>
</html>