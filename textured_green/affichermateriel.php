 <?php //Connection avec la BDD.
 session_start();
include("index.php");
include("menumateriel.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
       
       if(isset($_GET['search']) AND !empty($_GET['search']))
      {
                $search = htmlspecialchars($_GET['search']);
                $seaarch='%'.$search.'%';
    
            
            $mat = $pdo->prepare('SELECT * FROM materiel WHERE numserie LIKE ? OR eqp  LIKE ?');
            $mat->execute(array($seaarch,$seaarch));
            $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
    else{
         $search = NULL;
        $seaarch = NULL;
        $mat = $pdo->query("SELECT * FROM materiel");
        $mat->execute();
 
        //Fetch our rows. Array (empty if no rows). False on failure.
        $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
       


            
            



?>

<html>  
   <body>
       <h1>Liste du matériel</h1>
        <form method="GET"  id="search_form">
          <p>
            <input class="search" type="search" name="search" placeholder="Recherche..." />
            <input type="submit" value="Go"/>
          </p>
        </form>
        <table  style="width:100%; border-spacing:0;"><form name="form1" method="post" action="">
                <tr>

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
        

<?php


include "footer.php";

?>

        </form>
    </body>
</html>