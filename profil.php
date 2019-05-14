<?php
session_start();
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");
	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ? ");
		$requete_utilisateur -> execute(array($getid));
		$info_utilisateur = $requete_utilisateur -> fetch();
	
}
	if(isset($_SESSION['id']) AND $info_utilisateur['id'] == $_SESSION['id'] ) 
	{

	
?>

<html>
<head>
	<title><?php echo 'Profil de '.$info_utilisateur['pseudo'].''; ?></title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
	<div class="bandehaut z1">
				<div class="flex">

					<h1 class="ombre1 police1 aligntitre em"><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="blue">2</span>Chat</a></h1>
					<div class="accueilspace"></div>
				
					<p class="police1 em1 menu"><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>" class="anone blanc">Accueil</a></p>
					<div class="space2"></div>
					<p class="police1 em1 menu"><a href="profil.php?id=<?php echo $_SESSION['id']; ?>" class="anone blanc">Profil</a></p>
					<div class="space2"></div>
					<p class="police1 em1 menu"><a href="discussion.php?id=<?php echo $_SESSION['id']; ?>" class="anone blanc">Discussion</a></p>
					<div class="espace"></div>
					 <form class="menu em1" action="search.php" method="GET">
					   	 <input type="text" name="pseudo_recherche" style="width: 9vw; height: 0.8vw;">  
					   	 <input type="image" name="rechercher" src="images/search.png"  style="margin-left: -1vw; margin-bottom: -0.1vw; width: 0.8vw; height: 0.8vw;">
				   	</form>

					<div class="space1"></div>
						<p class="police1 em1 menu"><a href="deconnexion.php" class="anone blanc">Se déconnecter</a></p>
				</div>	
	</div>
	<br><br><br><br><br><br><br><br>
	<h1 class="police1 ombre" style="color: white; font-size: 1.5vw; margin-left: 25vw">MON COMPTE</h1>
	<div class="blocprofil" style="margin-left: 25vw;">
											<div style="margin-left: 1%; margin-top: 3%;">
											<div style="display: flex;">
												<?php

												if(!empty($info_utilisateur['avatar']))
												{
												?>
												<img style="border-radius: 50%; width: 5vw; height: 5vw; margin-top: 1.5vw;" src="avatars/<?php  echo $info_utilisateur['avatar']; ?>">
												<?php
												}

												?>
											<table>
												</tr>
												<tr>
													<td>
											<p><?php echo '<h1 style="color: #8c8c8c; font-size: 1vw;" class="police1 ombre">NOM D\'UTILISATEUR :<br> <span style="color: white;">'.$info_utilisateur['pseudo'].'</span></h1>'; ?></p>
												</td>
											</tr>
											<tr>
												<td>
													<p><?php echo '<h1 style="color: #8c8c8c; font-size: 1vw; margin-bottom: 2vw;" class="police1 ombre">EMAIL :<br> <span style="color: white;">'.$info_utilisateur['mail'].'</span></h1>'; ?></p>
												</td>		
											</tr>
										</table>
											<h1 class="police1 ombre"><a href="editionprofil.php?id=<?php echo $info_utilisateur['id']; ?>"  style="color: white; font-size: 1vw; margin-left: 28vw; text-decoration: none;" class="btnmodifier">Modifer</a></h1>
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