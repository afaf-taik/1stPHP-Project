<?php //Connection avec la BDD.
 session_start();
include("index.php");
include("menufournisseur.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
 
       if(isset($_GET['search']) AND !empty($_GET['search']))
      {
                $search = htmlspecialchars($_GET['search']);
                $seaarch='%'.$search.'%';
    
            
            $mat = $pdo->prepare('SELECT * FROM fournisseur WHERE nom_f LIKE ? ');
            $mat->execute(array($seaarch));
            $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
    else{
         $search = NULL;
        $seaarch = NULL;
        $mat = $pdo->query("SELECT * FROM fournisseur");
        $mat->execute();
 
        //Fetch our rows. Array (empty if no rows). False on failure.
        $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
       

?>

<html>  
   <body>
   <h1>Liste des fournisseurs</h1>
        <form method="GET"  id="search_form">
          <p>
            <input class="search" type="search" name="search" placeholder="Recherche..." />
            <input type="submit" value="Go"/>
          </p>
        </form>
       
         
        <table  style="width:100%; border-spacing:0;"><form name="form1" method="post" action="">
                <tr>
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
           

<?php


include ("footer.php");


?>

        </form>
    </body>
</html>