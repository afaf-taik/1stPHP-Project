<?php //Connection avec la BDD.
 session_start();
include("index.php");
include("menufournisseur.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
        $maxi=$pdo->query("SELECT max(id_f) FROM fournisseur");
        $maxi->execute();
        $maxx=$maxi->fetch(); 
        $mat = $pdo->query("SELECT * FROM fournisseur");
        $mat->execute();
 
        //Fetch our rows. Array (empty if no rows). False on failure.
        $rows = $mat->fetchAll(PDO::FETCH_ASSOC);
       

?>

<html>  
   <body>
       
         
        <table  style="width:100%; border-spacing:0;"><form name="form1" method="post" action="">
                <tr>
                    <th>#</th>
                    <th>id</th>
                    <th>Nom Fournisseur</th>
                    <th>Ville</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            foreach ($rows as $donnees)
            {
            ?>
                <tr>
                    <td bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<? echo $donnees['id_m']; ?>"></td>
                    <td align="center"><?php echo $donnees['id_f'];?></td>
                    <td align="center"><?php echo $donnees['nom_f'];?></td>
                    <td align="center"><?php echo $donnees['ville_f'];?></td>
                    <td align="center"><?php echo $donnees['tel_f'];?></td>
                    <td align="center"><?php echo $donnees['email_f'];?></td>
             

                </tr>
            <?php
                }
            ?>

           </table>
            </br></br>
            <input name="delete" type="submit" id="delete" value="Delete"></td>

<?php

// Check if delete button active, start this
if(isset($delete)){
$sql = $pdo->prepare("DELETE FROM fournisseur WHERE id_f=?");
for($i=0;$i<$maxx;$i++){
$del_id = $checkbox[$i];

$sql=$pdo->execute(array($del_id));

}
header('Location: afficherfrns.php' );
include "footer.php";
}

?>

        </form>
    </body>
</html>