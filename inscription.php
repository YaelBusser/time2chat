<?php

$bdd = new PDO("mysql:host=sql310.epizy.com;dbname=epiz_23760423_bdd","epiz_23760423","AoOnbuefkx7");

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
	<div class="bandehaut z1">
				<div class="flex">

					<h1 class="ombre1 police1 aligntitre em"><a href="index.html" class="anoneh1">Time<span class="blue">2</span>Chat</a></h1>
					<div class="accueilspace"></div>
				
					<p class="police1 em1 menu"><a href="index.html" class="anone blanc">Accueil</a></p>
					<div class="espace"></div>
					 <form class="menu em1" action="search.php" method="GET">
					   	 <input type="text" name="pseudo_recherche" style="width: 9vw; height: 0.8vw;">  
					   	 <input type="image" name="rechercher" src="images/search.png"  style="margin-left: -1vw; margin-bottom: -0.1vw; width: 0.8vw; height: 0.8vw;">
				   	</form>

					<div class="space1"></div>

							<p class="police1 em1 menu"><a href="connexion.php" class="anone blanc">Se connecter</a></p>
							<div class="space2"></div>

							<p class="police1 em1 menu"><a href="inscription.php" class="anone blanc">Inscription</a></p>
				</div>	
	</div>
	<br><br><br><br><br><br><br><br>
	<div class="auto" id="form">
	<form method="POST" action="" name="inscription">
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
<script type="text/javascript">
	document.inscription.pseudo.focus();
</script>
</body>
</html>