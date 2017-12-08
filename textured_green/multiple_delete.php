 <?php  
 $connect = mysqli_connect("localhost", "root", "", "gestion_materiel");  
 $sql = "SELECT * FROM agent";  
 $result = mysqli_query($connect, $sql);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="jquery.js"></script>  
           <style>  
                #box  
                {  
                     width:600px;  
                     background:gray;  
                     color:white;  
                     margin:0 auto;  
                     padding:10px;  
                     text-align:center;  
                }  
           </style>  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <h3 align="center">Delete multiple rows by selecting checkboxes using Ajax Jquery with PHP</h3><br />  
                <?php  
                if(mysqli_num_rows($result) > 0)  
                {  
                ?>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th>Matricule</th>  
                               <th>Email</th>  
                               <th>Delete</th>  
                          </tr>  
                <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                          <tr id="<?php echo $row["id_a"]; ?>">  
                               <td><?php echo $row["matricule"]; ?></td>  
                               <td><?php echo $row["email"]; ?></td>  
                               <td><input type="checkbox" name="customer_id[]" class="delete_customer" value="<?php echo $row["id_a"]; ?>" /></td>  
                          </tr>  
                <?php  
                     }  
                ?>  
                     </table>  
                </div>  
                <?php  
                }  
                ?>  
                <div align="center">  
                     <button type="button" name="btn_delete" id="btn_delete" class="btn btn-success">Delete</button>  
                </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#btn_delete').click(function(){  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                var id = [];  
                $(':checkbox:checked').each(function(i){  
                     id[i] = $(this).val();  
                });  
                if(id.length === 0) //tell you if the array is empty  
                {  
                     alert("Please Select atleast one checkbox");  
                }  
                else  
                {  
                     $.ajax({  
                          url:'delete.php',  
                          method:'POST',  
                          data:{id:id},  
                          success:function()  
                          {  
                               for(var i=0; i<id.length; i++)  
                               {  
                                    $('tr#'+id[i]+'').css('background-color', '#ccc');  
                                    $('tr#'+id[i]+'').fadeOut('slow');  
                               }  
                          }  
                     });  
                }  
           }  
           else  
           {  
                return false;  
           }  
      });  
 });  
 </script>  