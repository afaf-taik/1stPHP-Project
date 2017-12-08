<?php
session_start();
include("index.php");
include("menudemande.php");
$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
$result = $bdd->query("select * from Service");

if(isset($_POST['formajout']))
	{
		$srv=htmlspecialchars($_POST['srv']);
		$mat=htmlspecialchars($_POST['mat']);
		$descri=strip_tags($_POST['descri']);
		$descri=nl2br($descri);
		if( !empty($_POST['srv']) && !empty($_POST['mat']) )
		{
	
		$insertmat=$bdd->prepare("INSERT INTO demande(service,materiel,description) VALUES (?,?,?)");
		$insertmat->execute(array($srv,$mat,$descri)); 
		$erreur="Demande envoyée. ";



		}
		else
		{
		$erreur="Les informations que vous avez entrées sont incomplètes";
		}


	}


?>

<html>
	<head>
		<title>Gestion Materiel - Demande d'un nouveau matériel </title>
	</head>
	<body>
	<h1 class="w3-text-teal">Demande d'un nouveau matériel</h1>
	<div>
	<form action = "" method="post">
		<table>
			<tr>

			<tr><td align="right"><label for="srv">Service <font color=red>*</font>: </label></td> <td> <select name="srv" id='srv'><?php while ($row = $result->fetch()) {

                  unset($name);
                  $id = $row['id']; 
                  $name=$row['Nom_service'];
                  echo '<option value="'.$name.'">'.$name.'</option>';}?>
                  </select>

			</td></tr><br />
			<tr><td align="right"><label for="mat">Materiel demandé<font color=red>*</font>:</label></td><td><input type = "text" id ="mat" name = "mat"></td></tr><br />
			<tr><td align="right"><label for="descri">Détails :</label></td> <td><textarea rows="8" cols="50" name="descri"></textarea></td></tr><br />
			<br /><br /><br />
			<td></td><td align= "left"><input type = "submit"  value = "Ajouter" name= "formajout"></td></tr>
		</table>
		
	</form></div>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;} 
		include("footer.php");?></div>
</body>

</html>