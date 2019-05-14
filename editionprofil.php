<?php
session_start();
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");


	if(isset($_SESSION['pseudo']))
	{
		$requete_utilisateur = $bdd -> prepare("SELECT * FROM inscription WHERE id = ?");
		$requete_utilisateur -> execute(array($_SESSION['id']));
		$utilisateur = $requete_utilisateur -> fetch();	
	}
	if(isset($_POST['nouveau_mdp']) AND !empty($_POST['nouveau_mdp']) AND isset($_POST['nouveau_mdp2']) AND !empty($_POST['nouveau_mdp2']))
	{
		$mdp = sha1($_POST['nouveau_mdp']);
		$mpd2 = sha1($_POST['nouveau_mdp2']);
		if($mdp == $mpd2)
		{
			$insertpseudo = $bdd -> prepare("UPDATE inscription SET mdp = ? WHERE id = ?");
			$insertpseudo -> execute(array($mdp, $_SESSION['id']));
			header('Location: profil.php?id='.$_SESSION['id'].'');
		}
		else
		{
			$erreur = '<p style="color: white;" class="ombre police1">Le mot de passe n\'est pas le même !';
		}

	}
	if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
	{
		$taille_max = 2097152;
		$extension_valide = array('jpg', 'jpeg', 'png', 'gif');
		if($_FILES['avatar']['size'] <= $taille_max)
		{
			$extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			if(in_array($extension_upload, $extension_valide))
			{
				$chemin_avatar = "avatars/".$_SESSION['id'].".".$extension_upload;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin_avatar);
				if($resultat)
				{
					$update_avatar = $bdd -> prepare('UPDATE inscription SET avatar = :avatar WHERE id = :id');
					$update_avatar -> execute(array(
						'avatar' => $_SESSION['id'].".".$extension_upload,
						'id' => $_SESSION['id']
						));
					header('Location: profil.php?id='.$_SESSION['id'].''); 
				}
				else
				{
					$erreur = '<p style="color: white;" class="ombre police1">Une erreur s\' produite lors de l\'importation de votre avatar !</p>';
				}
			}
			else
			{
				$erreur = '<p style="color: white;" class="ombre police1">Votre avatar doit être au format : jpg, jpeg, png ou gif !</p>';
			}
		}
		else
		{
			$erreur = '<p style="color: white;" class="ombre police1">La taille du fichier doit être inférieur à 2 Mo !</p>';
		}
	}

	


?>

<html>
<head>
	<title>Edition du Profil</title>
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
	<h1 class="centre police1" style="color: white; font-size: 3vw; text-decoration: underline;">Edition de mon profil:</h1>
	<div align="center">
	<form method="POST" action="" enctype="multipart/form-data">
		<table>
			<tr>
				<td align="right" class="police1" style="color: white;"><label for="avatar">Avatar : </label></td>
				<td>
					<input type="file" name="avatar" id="avatar">
				</td>
			</tr>
			<tr>
				<td align="right">
					<label for="nouveau_mdp"><p class="police1" style="color: white;">Nouveau Mot De Passe</p></label>
				</td>
				<td>
					<input type="password" name="nouveau_mdp" placeholder="Votre Nouveau mdp" id="nouveau_mdp">
				</td>
			</tr>
			<tr>
				<td align="right">
					<label for="nouveau_mdp2"><p class="police1" style="color: white;">Confirmation du Mot De Passe</p></label>
				</td>
				<td>
					<input type="password" name="nouveau_mdp2" placeholder="Confirmation du mdp" id="nouveau_mdp2">
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="center"><br><input type="submit" name="form_edition_profil" value="Sauvegarder"></td>
			</tr>
			<tr>
				<td><br><?php if(isset($erreur)){ echo $erreur; }?></td>
			</tr>
		</table>
	</form>
	</div>

</body>
</html>