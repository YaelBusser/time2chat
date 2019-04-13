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
</head>
<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="accueil.php?id=<?php echo $utilisateur['id']; ?>" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div align="center">
		<p class="police1 btnlog vw1dot3 marginflex center"><a href="deconnexion.php" class="anone">Se déconnecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="accueil.php?id=<?php echo $utilisateur['id']; ?>">Accueil</a></li>
				<li><a href="profil.php?id=<?php echo $utilisateur['id']; ?>">Profil</a></li>
				<li><a href="">Discussion</a></li>
			</ul>
	</nav>
	</div>	
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