<?php
session_start();
include("index.php");

include("menufournisseur.php");

$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );

if(isset($_POST['formajout']))
	{
		$mail=htmlspecialchars($_POST['mail']);
		$telf=htmlspecialchars($_POST['telf']);
		$nomf=htmlspecialchars($_POST['nomf']);
		$ville=htmlspecialchars($_POST['ville']);
		if( !empty($_POST['nomf']) && !empty($_POST['ville']) && (!empty($_POST['mail']) || !empty($_POST['telf'])))
		{
	
		$insertmat=$bdd->prepare("INSERT INTO fournisseur(nom_f,ville_f,tel_f,email_f) VALUES (?,?,?,?)");
		$insertmat->execute(array($nomf,$ville,$telf,$mail)); 
		$erreur="Nouveau fournisseur ajouté.";



		}
		else
		{
		$erreur="Les informations que vous avez entrées sont incomplètes";
		}


	}


?>

<html>
	<head>
		<title>Gestion Materiel - Nouveau Fournisseur </title>
	</head>
	<body>
	<h2 align="center">Nouveau fournisseur</h2>
	<form action = "" method="post">
		<table>
			<tr>

			<tr><td align="right"><label for="nomf">Nom du fournisseur <font color=red>*</font>: </label></td> <td> <input type = "text" id ="nomf" name = "nomf"></td></tr><br />
			<tr><td align="right"><label for="ville">Ville<font color=red>*</font>:</label></td><td><input type = "text" id ="ville" name = "ville"></td></tr><br />
			<tr><td align="right"><label for="telf">Téléphone :</label></td> <td><input type = "text" name = "telf" id= "telf"></td><br />
			<tr><td align="right"><label for="mail">eMail :</label></td> <td><input type = "text" name = "mail" id= "mail"></td></tr><br /><br /><br />
			<td></td><td align= "left"><input type = "submit"  value = "Ajouter" name= "formajout"></td>
		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;
		include("footer.php");}?></div>
</body>

</html>