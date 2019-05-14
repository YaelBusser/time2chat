<?php
session_start();
$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");
	
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
	<div class="bandehaut z1">
				<div class="flex">

					<h1 class="ombre1 police1 aligntitre em"><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="blue">2</span>Chat</a></h1>
					<div class="accueilspace"></div>
				
					<p class="police1 em1 menu"><a href="accueil.php?id=<?php echo $_SESSION['id']; ?>" class="anone blanc">Accueil</a></p>
					<div class="espace"></div>
					 <form class="menu em1" action="search.php" method="GET">
					   	 <input type="text" name="pseudo_recherche" style="width: 9vw; height: 0.7vw;">  
					   	 <input type="image" name="rechercher" src="images/search.png"  style="margin-left: -1vw; margin-bottom: -0.1vw; width: 0.8vw; height: 0.8vw;">
				   	</form>

					<div class="space1"></div>

							<p class="police1 em1 menu"><a href="connexion.php" class="anone blanc">Se connecter</a></p>
							<div class="space2"></div>

							<p class="police1 em1 menu"><a href="inscription.php" class="anone blanc">Inscription</a></p>
				</div>	
	</div>
	<br><br><br><br><br><br><br><br>
  	<div align="center">

  		<?php
  		$recherche = $_GET['pseudo_recherche'];
  		$insertbdr = $bdd -> prepare('INSERT INTO bdr(pseudo_recherche, avatar) VALUES(?, ?)');
		$insertbdr -> execute(array($_GET['pseudo_recherche'], $info_utilisateur['avatar'],));

		$tous_les_avatars = $bdd -> query('SELECT * FROM inscription');
		$avatar = $tous_les_avatars -> fetch();

		$pseudod = $_GET['pseudo_recherche'];

		$requetepseudo = $bdd->prepare("SELECT COUNT(*) FROM inscription WHERE pseudo = ?");
		$requetepseudo->execute(array($pseudod));
		$pseudoexist = $requetepseudo->fetchColumn();


  		if(isset($_GET['pseudo_recherche']))
  		{
  			echo '<div align: center><a href="profil_principal.php?pseudo='.$_GET['pseudo_recherche'].'&avatar='.$avatar['avatar'].'">'.$_GET['pseudo_recherche'].'</a></div>';
  		}
  		else
  		{
  			echo '<div align: center><p>Le pseudo n\'existe pas !</p></div>';
  		}

  		?>
  		
  	</div>
</nav>
</body>
</html>