<?php //Connection avec la BDD.
 session_start();
include("index.php");


$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
 
       if(isset($_GET['search']) AND !empty($_GET['search']))
      {
                $search = htmlspecialchars($_GET['search']);
                $seaarch='%'.$search.'%';
    
            
            $mat = $pdo->prepare('SELECT * FROM demande WHERE materiel LIKE ? OR service LIKE ? OR description LIKE ? ');
            $mat->execute(array($seaarch));
            $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
    else{
         $search = NULL;
        $seaarch = NULL;
        $mat = $pdo->query("SELECT * FROM demande");
        $mat->execute();
 
        //Fetch our rows. Array (empty if no rows). False on failure.
        $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
       

?>

<html>  
   <body>
   <h1>Liste des demandes en attente</h1>
        <form method="GET"  id="search_form">
          <p>
            <input class="search" type="search" name="search" placeholder="Recherche..." />
            <input type="submit" value="Go"/>
          </p>
        </form>
       
         
        <table  style="width:100%; border-spacing:0;"><form name="form1" method="post" action="">
                <tr>
                    <th>id</th>
                    <th>Service</th>
                    <th>Materiel</th>
                    <th>Description</th>
                    
                </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            foreach ($rows as $donnees)
            { if($donnees['pending']==0) {
            ?>
                <tr>
                    <td align="center"><?php echo $donnees['id_d'];?></td>
                    <td align="center"><?php echo $donnees['service'];?></td>
                    <td align="center"><?php echo $donnees['materiel'];?></td>
                    <td align="center"><?php echo $donnees['description'];?></td>
            

                </tr>
            <?php
               } }
            ?>

           </table>
            </br></br>
           

<?php


include ("footer.php");


?>

        </form>
    </body>
</html>