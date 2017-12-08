<?php
session_start();
require '/opt/lampp/htdocs/PHPMailer/PHPMailerAutoload.php';
include("index.php");
include("menureclamation.php");
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
	
		$insertmat=$bdd->prepare("INSERT INTO reclamation(service,materiel,description) VALUES (?,?,?)");
		$insertmat->execute(array($srv,$mat,$descri)); 
		$erreur="Incident signalé. ";



		}
		else
		{
		$erreur="Les informations que vous avez entrées sont incomplètes";
		}


	}
if(isset($_POST['formsignal']))
{
$srv=htmlspecialchars($_POST['srv']);
$mat=htmlspecialchars($_POST['mat']);
$descri=strip_tags($_POST['descri']);
$descri=nl2br($descri);
$insertmat=$bdd->prepare("INSERT INTO reclamation(service,materiel,description) VALUES (?,?,?)");
$insertmat->execute(array($srv,$mat,$descri)); 

$frns1=$bdd->prepare("SELECT numserie, nom_f,email_f from fournisseur,materiel WHERE numserie=? AND materiel.fournisseur=fournisseur.nom_f ");
$frns1->execute(array($mat));
$mat1=$frns1->fetch();
$nom_f=$mat1['nom_f'];
$email_f=$mat1['email_f'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'stage2016ocp@gmail.com';                 // SMTP username
$mail->Password = 'ocp2016/';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                   // TCP port to connect to

$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress($email_f, $nom_f);     // Add a recipient
//$mail->addAddress();               // Name is optional
$mail->addReplyTo('stage2016ocp@gmail.com', 'AdminOcp');



$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Panne';
$mail->Body    = 'Une panne a survenu au materiel dont le numero de serie est'.$mat.'. Détails :'.$descri. '...Merci.';

if(!$mail->send()) {
    $erreur= 'Message could not be sent.';
    $erreur.='Mailer Error: ' . $mail->ErrorInfo;
} else {
    $erreur='Message envoyé';
}


}

?>

<html>
	<head>
		<title>Gestion Materiel - Incidents </title>
	</head>
	<body>
	<h2>Nouveau incident</h2>
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
			<tr><td align="right"><label for="mat">Materiel concerné <font color=red>*</font>:</label></td><td><input type = "text" id ="mat" name = "mat"></td><td font color=grey > (Numéro de série ) </td></tr><br />
			<tr><td align="right"><label for="descri">Détails de l'incident :</label></td> <td><textarea rows="8" cols="50" name="descri"></textarea></td><br />
			<br /><br /><br />
			<td></td><td align= "left"><input type = "submit"  value = "Ajouter" name= "formajout"></td>
			<td></td><td align= "left"><input type = "submit"  value = "SIgnaler d'urgence" name= "formsignal"></td>

		</table>
		
	</form>
	<div align = "center">

		<?php if(isset($erreur)) { echo '<font color=red>'.$erreur.'</font>' ;}
		  include("footer.php");?></div>
</body>

</html>