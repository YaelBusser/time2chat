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
	<nav>
		<div align="center">
	 <form action = "search.php" method = "GET" align="center">
   	 <input type="text" name="pseudo_recherche">
   	 <input type="submit" name="rechercher" value="Rechercher">
  </form>
</nav>
</div>
		</div>
								<div id="message">
								<div style="border: 1px solid red; background-color: white; width: 50%; height: 50%;margin-left: 25%; overflow: scroll; overflow-x: hidden;">
								<?php 
								$tous_les_msg =  $bdd -> query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 15');
								while($msg = $tous_les_msg -> fetch())
								{
								?>
									<div align="left">
									<p class="police1"><?php if(!empty($info_utilisateur['avatar'])) {?><a href="profil_principal.php?pseudo=<?php echo $msg['pseudo'] ?>&avatar=<?php echo $msg['avatar'] ?>"><img style="border-radius: 25%;" src="avatars/<?php  echo $msg['avatar']; ?>" width="50" height="50"></a> <span style="font-family: arial; text-decoration: underline;"><a href="profil_principal.php?pseudo=<?php echo $msg['pseudo'] ?>&avatar=<?php echo $msg['avatar'] ?>"><?php echo $msg['pseudo']; }?></a></span> <?php ; ?> :<br><br> <span style="margin-left: 5.5%;"><?php echo $msg['msg']; ?></span></p>
									</div>
								<?php
								}
								?>
							</div>
</div>
					<div align="center">
				<form method="post" action="" name="chat">
						<input type="text" name="msg" placeholder="Envoyer un message" autocomplete="off" style="width: 47.5vw">
						<input type="image" name="" src="images/msg.png" alt="Envoyer" style="width: 2vw; height: 2vw;">

				</form>
<script type="text/javascript">
	setInterval('chargement_message()', 1500);
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
