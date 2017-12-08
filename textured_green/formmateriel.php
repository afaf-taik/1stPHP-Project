<?php
session_start();
include("index.php");
include ("menumateriel.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
$result = $pdo->query("select * from Service");
$results = $pdo->query("select * from fournisseur");
if(isset($_POST['formajout']))
{
	$numserie=htmlspecialchars($_POST['numserie']);
	$eqp=htmlspecialchars($_POST['eqp']);
	$prix=htmlspecialchars($_POST['prix']);
	$srv=htmlspecialchars($_POST['srv']);
	$frns=htmlspecialchars($_POST['frns']);
	$duree=htmlspecialchars($_POST['duree']);
	$dmd=htmlspecialchars($_POST['dmd']);

	if(!empty($_POST['numserie']) && !empty($_POST['eqp'])&& !empty($_POST['prix']) && !empty($_POST['srv']) && !empty($_POST['frns']) )
	{
	
		$insertmat=$pdo->prepare("INSERT INTO materiel(numserie,eqp,prix,service,duree_garantie,fournisseur,id_demande) VALUES (?,?,?,?,?,?,?)");
		$insertmat->execute(array($numserie,$eqp,$prix,$srv,$duree,$frns,$dmd));
		$insertmat1=$pdo->prepare("UPDATE demande set pending=0 where id_d=?");
		$insertmat1->execute(array($dmd));


		$erreur="votre matériel a bien été ajouté";



	}
	else
	{
		$erreur="Les informations que vous avez entrées sont incomplètes";
	}

}

?>
<html>
<head>
	<title>Gestion Materiel - Nouveau Materiel </title>
</head>
<body>
</br></br>
	 <h1 class="w3-text-teal" align = "center">Nouveau matériel</h1>
	<form action = "" method="post">
		<table>
			<tr>
			   <td align="right">
			     <label for="numserie">Numero de serie <font color=red>*</font>:</label></td> 
			       <td><input type = "text" id ="numserie" name = "numserie" value="<?php if (isset($numserie)){ echo $numserie;}?>"></td></tr><br />
			       <tr><td align="right"><label for="dmd">Numero de demande</label></td> <td><input type = "text" name = "dmd" id = "dmd" value="<?php if (isset($dmd)){ echo $dmd;}?>" ></td></tr><br />
			<tr><td align="right"><label for="eqp">Equipement <font color=red>*</font>:</label></td> <td> <input type = "text" id ="eqp" name = "eqp" value="<?php if (isset($eqp)){ echo $eqp;}?>"></td></tr><br />
			<tr><td align="right"><label for="prix">Prix <font color=red>*</font>:</label></td><td><input type = "text" id ="prix" name = "prix" value="<?php if (isset($prix)){ echo $prix;}?>"></td></tr><br />
			<tr><td align="right"><label for="frns">Fournisseur <font color=red>*</font>: </label></td> <td> <select name="frns" id='frns'><?php while ($rows = $results->fetch()) {

                  unset($name);
                  $id = $rows['id']; 
                  $name=$rows['nom_f'];
                  echo '<option value="'.$name.'">'.$name.'</option>';}?>
                  </select>

			</td><td> <a href="formulairefrns.php"> Nouveau fournisseur ? </a> </td></tr><br />
			<tr><td align="right"><label for="dateachat">Date d'achat <font color=red>*</font>:</label></td> <td><input type = "date" name = "dateachat" id= "dateachat"></td></tr><br />
			<tr><td align="right"><label for="duree">Durée de garantie (mois)<font color=red>*</font>:</label></td> <td><input type = "text" name = "duree" id= "duree" value="<?php if (isset($duree)){ echo $duree;}?>"></td></tr><br />
			<tr><td align="right"><label for="srv">Service <font color=red>*</font>: </label></td> <td> <select name="srv" id='srv'><?php while ($row = $result->fetch()) {

                  unset($name);
                  $id = $row['id']; 
                  $name=$row['Nom_service'];
                  echo '<option value="'.$name.'">'.$name.'</option>';}?>
                  </select>

			</td></tr><br />
			<td></td><td align= "left"><input type = "submit" name="formajout" value = "Ajouter"></td>
		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}
		
		include("footer.php");?></div>
</body>
</html>