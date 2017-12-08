<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
$result = $bdd->query("select * from Service");
if(isset($_POST['forminscription']))
{
	$matricule=htmlspecialchars($_POST['matricule']);
	$mail=htmlspecialchars($_POST['mail']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$nom=htmlspecialchars($_POST['nom']);
	$srv=htmlspecialchars($_POST['srv']);
	$mdp=sha1($_POST['mdp']);
	$confmdp=sha1($_POST['confmdp']);
	if(!empty($_POST['nom']) && !empty($_POST['prenom'])&& !empty($_POST['mdp']) && !empty($_POST['confmdp']) && !empty($_POST['matricule']) && !empty($_POST['mail']) && !empty($_POST['srv'])){ 
		
		if(filter_var($mail,FILTER_VALIDATE_EMAIL))
			
		{
				if($mdp==$confmdp )
			{
					$insertmbr=$bdd->prepare("INSERT INTO agent(matricule,nom,prenom,service,email,motdepasse) VALUES (?,?,?,?,?,?)");
					$insertmbr->execute(array($matricule,$nom,$prenom,$srv,$mail,$mdp));
					$erreur="votre compte a bien été créé";
			}
			else
			{
			  $erreur="Veuillez confirmer correctement votre mot de passe !";
			}
		}
		else { $erreur="entrez une adresse mail valide";}
	}
	else{ $erreur= " Tous les champs doivent être complétés";}
	}

?>
<html>
	<head>
		<meta name="description" content="site de gestion du materiel de l ocp" />
  <meta name="keywords" content="SmartMat, OCP" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  <title>SmartMat - Inscription </title>
	</head>

<body>
<br /><br />
<h2 align='center'>Inscription</h2>
	<div align="center"> 
	<form action = "" method="post">
		<table align = "center">
			<tr>
			   <td align="right">
			     <label for="matricule">Matricule <font color=red>*</font>:</label></td> 
			       <td><input type = "text" id ="nmatricule" name = "matricule" value="<?php if (isset($matricule)){ echo $matricule;}?>"></td></tr><br />
			<tr><td align="right"><label for="nom">Nom<font color=red>*</font> :</label></td> <td> <input type = "text" id ="nom" name = "nom" value="<?php if (isset($nom)){ echo $nom;}?>"></td></tr><br />
			<tr><td align="right"><label for="prenom">Prenom <font color=red>*</font> :</label></td><td><input type = "text" id ="prenom" name = "prenom" value="<?php if (isset($prenom)){ echo $prenom;}?>"></td></tr><br />
			<tr><td align="right"><label for="srv">Service <font color=red>*</font>: </label></td> <td> <select name="srv" id='srv'><?php while ($row = $result->fetch()) {

                  unset($name);
                  $id = $row['id']; 
                  $name=$row['Nom_service'];
                  echo '<option value="'.$name.'">'.$name.'</option>';}?>
                  </select>

			</td></tr><br />
		
			<tr><td align="right"><label for="mail">eMail <font color=red>*</font>:</label></td> <td><input type = "email" name = "mail" id= "mail" value="<?php if (isset($mail)){ echo $mail;}?>"></td></tr><br />
			<tr><td align="right"><label for="mdp">Mot de Passe <font color=red>*</font>:</label></td> <td><input type = "password" name = "mdp" id= "mdp" ></td></tr><br />
			<tr><td align="right"><label for="confmdp">Confirmez votre mot de passe <font color=red>*</font>:</label></td> <td><input type = "password" name = "confmdp" id = "confmdp"></td></tr><br />
			<td></td><td><input type = "submit" value = "Inscription" name="forminscription" align="right"></td>
		</table>
		
	</form></div>
	<div align = "center">

		<?php if(isset($erreur)) { echo $erreur ;}?></div>
</body>
		
</html>
