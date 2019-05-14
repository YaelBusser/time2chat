<?php
session_start();



	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ? ");
		$requete_utilisateur -> execute(array($getid));
		$info_utilisateur = $requete_utilisateur -> fetch();
	}

	if(isset($_POST['msg']) AND !empty($_POST['msg']))
	{
		$msg = htmlspecialchars($_POST['msg']);
		$insertmsg = $bdd -> prepare('INSERT INTO chat(msg, pseudo, avatar, idpseudo) VALUES(?, ?, ?, ?)');
		$insertmsg -> execute(array($msg, $info_utilisateur['pseudo'], $info_utilisateur['avatar'], $info_utilisateur['id']));

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
		<div class="separation"></div>
	<div class="blocdumilieu">
		

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
