<html>
	<head>
		<title>Gestion Materiel - Suppression d'un matériel </title>
	</head>
	<body>
	<form action = "delete_mat.php" method="post">
		<table>
			<tr>

			<tr><td align="right"><label for="srv">Numéro de Série <font color=red>*</font>: </label></td> <td> <input type = "text" id ="srv" name = "srv"></td></tr><br />
			<tr><td align="right"><label for="mat">Motif de suppression<font color=red>*</font>:</label></td><td><select name="facon_h">
 							 <option value="">Selectionner...</option>
  							<option value="vente">Vente</option>
  							<option value="don">Don</option>
								</select></td></tr><br />


			<tr><td align="right"><label for="telf">Prix de vente :</label></td> <td><input type = "text" name = "desc" id= "desc" rows="8" cols="50"></td><td></td><br />
			<br /><br /><br />
			<td></td><td align= "left"><input type = "submit"  value = "Supprimer" name= "formajout"></td>
		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}?></div>
</body>

</html>
