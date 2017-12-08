<?php //Connection avec la BDD.
 session_start();
include("index.php");
include("menuagents.php");

$pdo = new PDO('mysql:host=localhost;dbname=gestion_materiel','root','' );
 
       if(isset($_GET['search']) AND !empty($_GET['search']))
      {
                $search = htmlspecialchars($_GET['search']);
                $seaarch='%'.$search.'%';
    
            
            $mat = $pdo->prepare('SELECT * FROM  agent WHERE nom LIKE ? OR  prenom LIKE  ? OR matricule LIKE ? OR service LIKE ? OR email LIKE ? ');
            $mat->execute(array($seaarch,$seaarch,$seaarch,$seaarch,$seaarch));
            $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
    else{
         $search = NULL;
        $seaarch = NULL;
        $mat = $pdo->query("SELECT * FROM agent");
        $mat->execute();
 
        //Fetch our rows. Array (empty if no rows). False on failure.
        $rows = $mat->fetchAll(PDO::FETCH_ASSOC);}
       

?>

<html>  
   <body>
   <h1>Liste des agents</h1>
        <form method="GET"  id="search_form">
          <p>
            <input class="search" type="search" name="search" placeholder="Recherche..." />
            <input type="submit" value="Go"/>
          </p>
        </form>
       
         
        <table  style="width:100%; border-spacing:0;"><form name="form1" method="post" action="">
                <tr>
                    <th>id</th>
                    <th>Matricule </th>
                    <th>Nom </th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Service</th>
                </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            foreach ($rows as $donnees)
            {
            ?>
                <tr>
                
                    <td align="center"><?php echo $donnees['id_a'];?></td>
                     <td align="center"><?php echo $donnees['matricule'];?></td>
                    <td align="center"><?php echo $donnees['nom'];?></td>
                    <td align="center"><?php echo $donnees['prenom'];?></td>
                    <td align="center"><?php echo $donnees['email'];?></td>
                    <td align="center"><?php echo $donnees['service'];?></td>
             

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