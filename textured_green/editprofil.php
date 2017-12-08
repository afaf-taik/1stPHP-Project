<?php
session_start();
include("index.php");
$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
$result = $bdd->query("select * from Service");
$req=$bdd->prepare("SELECT * FROM agent where id_a=?");
$req->execute(array($_SESSION['id']));
$user=$req->fetch();
	
if(isset($_POST['formedit'])){
	if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) 
	{
		$newemail=htmlspecialchars($_POST['newmail']);
		$majmail=$bdd->prepare("UPDATE agent set email=? where id=?");
		$majmail->execute(array($newemail,$_SESSION['id']));
	}
	if(isset($_POST['newsrv']) AND !empty($_POST['newsrv']) AND $_POST['newsrv'] != $user['service'])
	{
		$newsrv=htmlspecialchars($_POST['newsrv']);
		$majsrv=$bdd->prepare("UPDATE agent set service=? where id_a=?");
		$majsrv->execute(array($newsrv,$_SESSION['id']));
	}
	if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1'])  AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
	{
		$mdp1=sha1($_POST['newmdp1']);
		$mdp2=sha1($_POST['newmdp2']);
		if($mdp1==$mdp2)
      {
		$majmdp=$bdd->prepare("UPDATE agent set motdepasse=? where id=?");
		$majmail->execute(array($mdp1,$_SESSION['id']));}
		else
		{
			$erreur="Veuillez confirmez correctement votre mot de passe.";
		}
	}
}


?>
<html>
	<head>
		<title>Edition de mon profil </title>
	</head>
	<body>
<body>
<br /><br /><br />
	<form action = "" method="post">
		<table align = "center">
		<tr><td align="right"><label for="newsrv">Service <font color=red>*</font>: </label></td> <td> <select name="newsrv" id='newsrv'><?php while ($row = $result->fetch()) {

                  unset($name);
                   
                  $name=$row['Nom_service'];
                  if($_SESSION['srv']==$name)
                  {
                  	echo '<option value="'.$name.'" selected="selected">'.$name.'</option>';
                  }
                  else{
                  echo '<option value="'.$name.'">'.$name.'</option>';}}?>
                  </select>

			</td></tr><br />
			<tr>
			   <td align="right">
			<tr><td align="right"><label for="newmail">eMail :</label></td> <td><input type = "email" name = "newmail" id= "newmail" value="<?php echo $user['email'];?>"></td></tr><br />
			<tr><td align="right"><label for="newmdp">Nouveau mot de Passe :</label></td> <td><input type = "password" name = "newmdp" id= "newmdp" ></td></tr><br />
			<tr><td align="right"><label for="newmdp1">Nouveau mot de Passe :</label></td> <td><input type = "password" name = "newmdp1" id= "newmdp1" ></td></tr><br />
			<tr><td align="right"><label for="newsrv">Service :</label></td> <td><input type = "text" name = "newsrv" id= "newsrv" ></td></tr><br />
		</table>
		<td></td><td><input type = "submit" value = "Éditer" name="formedit" align="right"></td>
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}
		   include("footer.php");?></div>
</body>
		
</html>

