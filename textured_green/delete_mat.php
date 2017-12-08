<?php 
session_start();
include("index.php");
include("menumateriel.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','');
if(isset($_POST['formdel']))
	{
		$numserie=htmlspecialchars($_POST['numserie']);
		$facon_h=htmlspecialchars($_POST['facon_h']);
		$prix_vente=htmlspecialchars($_POST['prix_vente']);

		if(!empty($_POST['numserie']))
			{	

				$fetchmat=$pdo->prepare("SELECT * from materiel where numserie=?");
				$fetchmat->execute(array($numserie));
				$mat=$fetchmat->fetchAll();
				$count = $mat->rowCount();

				if($count==1)
					{
						$eqp=$mat['eqp'];
						$prix_achat=$mat['prix'];
						$suppr=$pdo->prepare("DELETE from materiel where numserie=?");
						$suppr->execute(array($numserie));
						if($facon_h=='Vente')
								{
							$insermat=$pdo->prepare("INSERT into historique_materiel(numserie,eqp,prix_achat,facon_h,prix_vente,date_h) values (?,?,?,?,?)");
							$insermat->execute(array($numserie,$eqp,$prix_achat,$facon_h,$prix_vente));
								}
					}
			}
	
	}
?>


<html>
	<head>
		<title>Gestion Materiel - Suppression d'un matériel </title>
	</head>
	<body>
	<h1 class="w3-text-teal">Suppression matériel</h1>
	<form action = "" method="post">
		<table>
			<tr>

			<tr><td align="right"><label for="srv">Numéro de Série <font color=red>*</font>: </label></td> <td> <input type = "text" id ="srv" name = "srv"></td></tr><br />
			<tr><td align="right"><label for="mat">Motif de suppression<font color=red>*</font>:</label></td><td><select name="facon_h">
 							 <option value="">Selectionner...</option>
  							<option value="vente">Vente</option>
  							<option value="don">Don</option>
								</select></td></tr><br />


			<tr><td align="right"><label for="telf">Prix de vente :</label></td> <td><input type = "text" name = "desc" id= "desc" rows="8" cols="50"></td><td></td>
				</tr><br />
			<br /><br /><br />
			<td></td><td align= "left"><input type = "submit"  value = "Supprimer" name= "formajout"></td></tr>
		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;
	       include("footer.php");}?></div>
</body>
</html>