<?php
session_start();

	
	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getpseudo = $_GET['pseudo'];
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE pseudo = ? ");
		$requete_utilisateur -> execute(array($getpseudo));
		$info_utilisateur = $requete_utilisateur -> fetch();
	
}
?>
<!DOCTYPE html>

<html>

<head>
	<title>Time2Chat</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>

<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="index.html" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div class="flex">
	</div>
		<nav>
			<ul class="police1">
				<li><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>">Accueil</a></li>
				<li><a href="chat.php">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<div class="flex">

	<h1 class="vw10 bleufonce ombre police1 aligntitre"><a href="index.html" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>

</div>
<nav>
	 <form action = "search.php" method = "GET" align="center">
   	 <input type="text" name="pseudo_recherche">
   	 <input type="submit" name="rechercher" value="Rechercher">
  </form>
  	<div align="center">

  		<?php
  					$requetepseudo = $bdd->prepare("SELECT COUNT(*) FROM inscription WHERE pseudo = ?");
					$requetepseudo->execute(array($_GET['pseudo_recherche']));
					$pseudoexist = $requetepseudo->fetchColumn();

  		if(isset($_GET['pseudo_recherche']))
  		{
  			echo '<div align: center><a href="profil_principal.php?pseudo=<?php echo $msg["pseudo"] ?>&avatar=<?php echo $msg["avatar"] ?>"">'.$_GET['pseudo_recherche'].'</a></div>';
  		}


  		?>
  		
  	</div>
</div>
</nav>
</body>
</html>
