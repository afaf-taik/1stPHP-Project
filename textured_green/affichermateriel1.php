 <?php //Connection avec la BDD.
 session_start();
include("index.php");
include("menumateriel.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
        $maxi=$pdo->query("SELECT max(id_m) FROM materiel");
        $maxi->execute();
        $maxx=$maxi->fetch(); 
        $mat = $pdo->query("SELECT * FROM materiel");
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
                    <th>Numéro de série</th>
                    <th>Équipement</th>
                    <th>Service</th>
                    <th>Prix</th>
                    <th>Fournisseur</th>
                    <th>Date d'achat</th>
                    <th>Durée de garantie (mois)</th>
                </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            foreach ($rows as $donnees)
            {
            ?>
                <tr>
                    <td bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<? echo $donnees['id_m']; ?>"></td>
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

           </table>
            </br></br>
            <input name="delete" type="submit" id="delete" value="Delete"></td>

<?php

// Check if delete button active, start this
if(isset($delete)){
$sql = $pdo->prepare("DELETE FROM materiel WHERE id_m=?");
for($i=0;$i<$maxx;$i++){
$del_id = $checkbox[$i];

$sql=$pdo->execute(array($del_id));

}
header('Location: affichermateriel.php' );
include "footer.php";
}

?>

        </form>
    </body>
</html>