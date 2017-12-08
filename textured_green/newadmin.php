<?php
session_start();
include("index.php");


$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );

if(isset($_POST['formajout']))
	{
		$x=htmlspecialchars($_POST['x']);
		
				if( !empty($_POST['x']) )
		{
	
		$insertmat=$bdd->prepare("UPDATE agent set admin=1 WHERE matricule=? OR email=?");
		$insertmat->execute(array($x,$x)); 
		$erreur="Nouveau admin ajouté.";



		}
		else
		{
		$erreur="Les informations que vous avez entrées sont incomplètes";
		}


	}
if(isset($_POST['formsuppr']))
	{
		$x=htmlspecialchars($_POST['x']);
		
				if( !empty($_POST['x']) )
		{
	
		$insertmat=$bdd->prepare("DELETE from agent WHERE matricule=? OR email=?");
		$insertmat->execute(array($x,$x)); 
		$erreur="Agent supprimé.";



		}
		else
		{
		$erreur="Les informations que vous avez entrées sont incomplètes";
		}


	}


?>

<html>
	<head>
		<title>Gestion Agents </title>
	</head>
	<body>
	<form action = "" method="post">
		<table>
			<tr><td align="right"><label for="x">Matricule ou email de l'agent <font color=red>*</font>: </label></td> <td> <input type = "text" id ="x" name = "x"></td></tr><br />
			<td></td><td align= "left"><input type = "submit"  value = "Ńommer comme admin" name= "formajout"></td>
			<td></td><td align= "left"><input type = "submit"  value = "Supprimer" name= "formsuppr"></td>
		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}
		include("footer.php");?></div>
</body>

</html>