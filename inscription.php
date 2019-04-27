<?php

if(isset($_POST['forminscription']))
{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		$pseudo16 = strlen($pseudo);

	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		if($pseudo16 <=16)
		{
			if($mail == $mail2)
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					$requetepseudo = $bdd->prepare("SELECT COUNT(*) FROM inscription WHERE pseudo = ?");
					$requetepseudo->execute(array($pseudo));
					$pseudoexist = $requetepseudo->fetchColumn();
					if ($pseudoexist == 0)
					{

						$requetemail = $bdd -> prepare("SELECT * FROM inscription WHERE mail = ?");
						$requetemail -> execute(array($mail));
						$mailexist = $requetemail -> rowCount();
						if($mailexist == 0)
						{
							if($mdp == $mdp2)
							{
								$insertmembre = $bdd -> prepare("INSERT INTO inscription(pseudo, mail, mdp) VALUES(?, ?, ?)");
								$insertmembre -> execute(array($pseudo, $mail, $mdp));
								header('Location: creationdecompte.php');
							}
							else
							{
								$erreur = '<p style="color: white;" class="ombre police1">Votre mot de passe ne correspond pas !</p>';
							}
						}
						else
						{
							$erreur = '<p style="color: white;" class="ombre police1">Cette Adresse mail existe déjà !';
						}
					}
					else
					{
						$erreur = '<p style="color: white;" class="ombre police1">Ce pseudo existe déjà !</p>';
					}
				}
				else
				{
					$erreur = '<p style="color: white;" class="ombre police1">Votre mail n\'est pas valide !';
				}
			}
			else
			{
				$erreur = '<p style="color: white;" class="ombre police1">Votre mail ne correspond pas !</p>';
			}
		}
		else
		{
			$erreur = '<p style="color: white;" class="ombre police1">Votre pseudo ne doit pas dépasser 16 caractères!<p>';
		}

	}
	else
	{
		$erreur = '<p style="color: white;" class="ombre police1">Tous les champs doivent être complétés !</p>';
	}
}


?>

<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta charset="utf-8">
	<link rel="icon" type="icon" href="images/t2c.png">
</head>
<body>
	<div class="bandegauche z1">
		<h1 class="centre bleufonce ombre vw2 police1 "><a href="index.html" class="anoneh1">Time<span class="bleuclair">2</span>Chat</a></h1>
		<div class="flex">
		<p class="police1 btnlog vw1dot3 marginlog"><a href="inscription.php" class="anone">Inscription</a></p>
		<p class="police1 btnlog vw1dot3 marginflex"><a href="connexion.php" class="anone">Se connecter</a></p>
	</div>
		<nav>
			<ul class="police1">
				<li><a href="index.html">Accueil</a></li>
				<li><a href="chat.php">Discussion</a></li>
			</ul>
		</nav>
	</div>	
	<div class="auto" id="form">
	<form method="POST" action="">
		<table>
			<tr>
				<td></td>
				<td><h1 class="police1 blanc ombre" style="color: white;">Inscription</h1></td>
			</tr>
			<tr>
				<td align="right"><label for="pseudo" style="color: white" class="ombre police1">Pseudo</label></td>
				<td><input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudo" autocomplete="off" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>"></td>
			</tr>
			<tr>
				<td align="right"><label for="mail" style="color: white;" class="ombre police1">mail</label></td>
				<td><input type="email" name="mail" placeholder="Votre mail" id="mail" autocomplete="off" value="<?php if(isset($mail)) { echo $mail;} ?>"></td>
			</tr>
			<tr>
				<td align="right"><label for="mail2" style="color: white;" class="ombre police1">Confirmation du Mail</label></td>
				<td><input type="email" name="mail2" id="mail2" placeholder="Confirmation du mail" autocomplete="off" value="<?php if(isset($mail2)){ echo $mail2;} ?>"></td>
			</tr>
			<tr>
				<td align="right"><label for="mdp" style="color: white;" class="ombre police1">Mot de passe</label></td>
				<td><input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" autocomplete="off"></td>
			</tr>
			<tr>
				<td align="right"><label for="mdp2" style="color: white;" class="ombre police1">Confirmation du mot de passe</label></td>
				<td><input type="password" name="mdp2" id="mdp2" placeholder="Confirmation du mdp" autocomplete="off"></td>
			</tr>
			<tr>
				<td></td>
				<td align="center"><br><input type="submit" name="forminscription" value="Je m'inscris"></td>
			</tr>
		</table>
		<br>
		<div class="marginerreur">
		<?php

		if(isset($erreur))
		{
			echo $erreur;
		}

		?>
	</div>
	</form>
	</div>
</div>
</body>
</html>
