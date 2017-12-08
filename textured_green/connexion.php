<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
if(isset($_POST['formcnx']))
{
	$mailc=htmlspecialchars($_POST['mail']);
	$mdpc=sha1($_POST['mdp']);
	if(!empty($mailc) AND !empty($mdpc))
	{

		$req=$bdd->prepare("SELECT * FROM agent where email=? and motdepasse=?");
		$req->execute(array($mailc,$mdpc));
		$userex=$req->rowCount();
		if($userex==1)
		{
			$userinfo=$req->fetch();
			$_SESSION['id']=$userinfo['id_a'];
			$_SESSION['matricule']=$userinfo['matricule'];
			$_SESSION['mail']=$userinfo['email'];
			$_SESSION['srv']=$userinfo['service'];
			$_SESSION['admin']=$userinfo['admin'];
			header("Location: acceuil.php");

		}
		else
		{ 
			$erreur="Email ou mot de passe erroné!";
		}
	}
	else
	{
		$erreur="Les deux champs doivent être remplis !";
	}

}
?>


<html>
	<head>
  <title>Smartmat OCP</title>
  <meta name="description" content="site de gestion du materiel de l ocp" />
  <meta name="keywords" content="SmartMat, OCP" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  <title>Gestion Materiel - Connexion </title>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
      <img src='smartmat.png' alt="Logo SmartMat" height="250" width="150">
      </br> </br><br />
     </div>
    </div></div>
	<div align = "center">

	<form action = "" method="post">
		<table align = "center">
			<tr>
			   <td align="right">
			<tr><td align="right"><label for="mail">eMail :</label></td> <td><input type = "email" name = "mail" id= "mail" value="<?php if (isset($mail)){ echo $mail;}?>"></td></tr><br />
			<tr><td align="right"><label for="mdp">Mot de Passe :</label></td> <td><input type = "password" name = "mdp" id= "mdp" ></td></tr><br />
		</table>
		<td></td><td><input type = "submit" value = "Connexion" name="formcnx" align="right"></td>
	</form>
	</br></br></br>
		Vous n'avez pas de compte ? <a href="formulaire_inscription.php" >Inscrivez-vous </a> .
		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}?></div>
</body>
		
</html>
