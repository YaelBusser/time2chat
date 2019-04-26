<?php
session_start();

$bdd = new PDO("mysql:host=sql310.epizy.com;","","");

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
	$insertpseudo = $bdd -> prepare('SELECT * FROM chat WHERE pseudo = ?');
	$insertpseudo -> execute(array($info_utilisateur['pseudo']));

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
		<div style="border: 1px solid red; background-color: white; width: 50%; height: 50%;margin-left: 25%; overflow: scroll; overflow-x: hidden;">
								<div id="message">
								
								<?php 
								$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id ');
								while($msg = $tous_les_msg -> fetch())
								{
								?>
									<div align="left">
									<p><?php if(!empty($info_utilisateur['avatar'])) {?><img src="avatars/<?php  echo $info_utilisateur['avatar']; ?>" width="50" height="50"> <?php }?> <?php echo $info_utilisateur['pseudo'] ; ?> : <?php echo $msg['msg']; ?></p>
									</div>
								<?php
								}
								?>
							</div>
</div>
					<div align="center">
				<form method="post" action="" name="chat">
						<input type="text" name="msg" placeholder="Envoyer un message" autocomplete="off">
						<input type="submit" name="" value="Envoyer">

				</form>
<script type="text/javascript">
	setInterval('chargement_message()', 500);
	function chargement_message(){
		$('#message').load('chargement_message.php');
	}
</script>

<script type="text/javascript">
	document.chat.msg.focus();
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
