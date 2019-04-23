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

	if(isset($_POST['msg']) AND !empty($_POST['msg']))
	{
		$msg = htmlspecialchars($_POST['msg']);
		$insertmsg = $bdd -> prepare('INSERT INTO chat(msg) VALUES(?)');
		$insertmsg -> execute(array($msg));
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
				<li><a href="chat.php">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<div class="flex">

	<h1 class="vw10 bleufonce ombre police1 aligntitre"><a href="accueil.php?id=<?php echo $info_utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
</div>
		</div>
			<div id="message">
				<div align="center">
			<?php

			$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 5');
			while($msg = $tous_les_msg -> fetch())
			{
			?>
			<div align="center">
				<div style="width: 25%; background-color: red;">
					<div align="left">
				<p><?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo']; } ; ?></b> : <?php echo $msg['msg']; ?></p>
					</div>
				</div>
			</div>
		</div>
			<?php
			}
			?>
		</div>

					<div align="center">
				<form method="post" action="">
						<textarea type="text" name="msg" placeholder="MESSAGE"></textarea>
						<input type="submit" name="" value="Envoyer">

				</form>
<script type="text/javascript">
	setInterval('chargement_message()', 1500);
	function chargement_message(){
		$('#message').load('chargement_message.php');
	}
</script>

<?php
}
else
{
	echo '<h1 style="text-align: center;">Erreur dans l\'url !</h1>';
}
?>
</body>
</html>
