<?php
error_reporting(E_ALL);
$db = new PDO('mysql:host=localhost;dbname=gestion_materiel', 'root','');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db->prepare("SELECT * FROM materiel ORDER BY id_m DESC");
$result->execute();
$mat=$result->fetchAll(PDO::FETCH_ASSOC);
if(isset($delete)) {
	$r= $db->prepare("DELETE FROM materiel WHERE id_m= ?");
	foreach($_POST['selector'] as $edit)
	{
	
		$r->execute(array($edit));
	}
}

?>

<html>
<form action="" method="post">
<table border="1" cellspacing="0" cellpadding="2" >
<thead>
	<tr>
		<th>#</th>
                    <th>id</th>
                    <th>Numéro de série</th>
                    <th>Équipement</th>
                    <th>Service</th>
                    <th>Prix</th>
                    <th>Fournisseur</th>
                    <th>Date d'achat</th>
                    <th>Durée de garantie (mois)</th>
	</tr>
</thead>
<tbody>
	<?php

		foreach($mat as $donnees){
	?>
	<tr class="record">
		<td><input id ="selector[]" name="selector[]" type="checkbox" value="<?php echo $row['id_m']; ?>"></td>
		<td align="center"><?php echo $donnees['id_m'];?></td>
        <td align="center"><?php echo $donnees['numserie'];?></td>
        <td align="center"><?php echo $donnees['eqp'];?></td>
        <td align="center"><?php echo $donnees['service'];?></td>
        <td align="center"><?php echo $donnees['prix'];?></td>
        <td align="center"><?php echo $donnees['fournisseur'];?></td>
        <td align="center"><?php echo $donnees['date_achat'];?></td>
        <td align="center"><?php echo $donnees['duree_garantie'];?></td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>
<input type="submit" value="Supprimer" name="delete" />
</form>
</html>