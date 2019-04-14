<?php
session_start();

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=","","");

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ? ");
		$requete_utilisateur -> execute(array($getid));
		$info_utilisateur = $requete_utilisateur -> fetch();
	}
	if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
	{
	 $_GET['terme'] = htmlspecialchars($_GET['terme']); //pour sécuriser le formulaire contre les intrusions html
	 $terme = $_GET['terme'];
	 $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
	 $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
	}

	if (isset($terme))
		 {
		  $terme = strtolower($terme);
		  $select_terme = $bdd->prepare("SELECT titre, contenu FROM bdr WHERE titre LIKE ? OR contenu LIKE ?");
		  $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
		 }
		 else
		 {
		  $message = "Vous devez entrer votre requete dans la barre de recherche";
		 }

	if(isset($_SESSION['id']) AND $info_utilisateur['id'] == $_SESSION['id'])
	{

	
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
				<li><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>">Accueil</a></li>
				<li><a href="profil.php?id=<?php echo $info_utilisateur['id']; ?>">Profil</a></li>
				<li><a href="">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<div class="flex">

	<h1 class="vw10 bleufonce ombre police1 aligntitre"><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
</div>
	<div align="center">
   <form action = "recherche.php" method = "get" align="center">
   <input type = "search" name = "terme" style="width: 15vw; font-size: 2vw;" placeholder="Pseudonyme">
   <input type = "submit" name = "s" value = "Rechercher" style="font-size: 2vw;">
  </form>
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