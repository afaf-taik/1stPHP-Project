<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Supprimer</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.min.css"/>
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Are you sure to delete?");
    if(result){
        return true;
    }else{
        return false;
    }
}
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
</head>
<body>
  <?php
  $host="127.0.0.1";
  $user="root";
  $pass="";
  $dbname="gestion_materiel";
  $db= new PDO("mysql::host=$host;dbname=$dbname",$user,$pass);
  $sql="select * from materiel";
  $result=$db->query($sql);
  $result->setfetchmode(PDO::FETCH_ASSOC);
?>
    
<form name="form" action="deleting.php" method="post" onsubmit="return deleteConfirm();">
	   <table class="table table-hover" cellspacing="3" cellpadding="2" border="2" style="width:60%; margin:auto">
        <thead>
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
        </thead>	
        <tbody>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
                   while( $donnees=$result->fetch())
            {
            ?>
                <tr>
                     <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="$donnees['id_m']" ></td>
                    <td align="center"><?php echo $donnees['id_m'];?></td>
                    <td align="center"><?php echo $donnees['numserie'];?></td>
                    <td align="center"><?php echo $donnees['eqp'];?></td>
                    <td align="center"><?php echo $donnees['service'];?></td>
                    <td align="center"><?php echo $donnees['prix'];?></td>
                    <td align="center"><?php echo $donnees['fournisseur'];?></td>
                    <td align="center"><?php echo $donnees['date_achat'];?></td>
                    <td align="center"><?php echo $donnees['duree_garantie'];?></td>
             

         		</tr>
         </tbody>
              <?php 
		 }
		$db=null;
		?>


		     <tr>
        	<td align="left"> <strong>Séléctionner tout <input type="checkbox" name="select_all" id="select_all" value=""/> </strong> </td>
            
            <td colspan="4" align="center">  <input type="submit" class="btn btn-danger" name="bulk_delete_submit" value="Supprimer"/> </td>
        </tr>
        
    </table>

</form>
</body>
</html>











