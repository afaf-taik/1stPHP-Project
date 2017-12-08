 <?php  
 $connect = mysqli_connect("localhost", "root", "", "gestion_materiel");  
 if(isset($_POST["id"]))  
 {  
      foreach($_POST["id"] as $id)  
      {  
           $sql = "DELETE FROM agent WHERE id_a = '".$id."'";  
           mysqli_query($connect, $sql);  
      }  
 }  
 ?> 