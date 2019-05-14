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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
	<div class="bandehaut z1">
				<div class="flex">

					<h1 class="ombre1 police1 aligntitre em"><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>" class="anoneh1">Time<span class="blue">2</span>Chat</a></h1>
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
	<h1 class="centre police1 ombre" style="color: white; font-size: 3vw; text-decoration: underline;"><img style="border-radius: 25%;" src="avatars/<?php  echo $_GET['avatar']; ?>" width="250" height="250"><span style="color: #66ccff; margin-left: 15%;"><?php echo $_GET['pseudo']; ?></span>

	</h1>


</body>
</html>