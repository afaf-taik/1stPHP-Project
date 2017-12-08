<html>
<head>
  
  <meta name="description" content="site de gestion du materiel de l ocp" />
  <meta name="keywords" content="SmartMat, OCP" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
      <img src='logoocp.png' alt="Logo OCP" height="125" width="85">
      </br> </br>
   <?php if(empty($_SESSION['id'])){ 
          
       header("Location:connexion.php");
       


        }
        elseif( $_SESSION['admin']==1){?>
       
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="acceuil.php">Home</a></li>
          <li><a href="formmateriel.php">Materiel</a></li>
          <li><a href="formulairefrns.php">Fournisseurs</a></li>
          <li><a href="formdemande.php">Demandes</a></li>
          <li><a href="formreclamation.php">Reclamations</a></li>
          <li><a href="afficheragents.php">Agents</a></li>
        </ul>
      </div>
    <?php } else {?> 
       <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="acceuil.php">Home</a></li>
          <li><a href="formmateriel.php">Materiel</a></li>
          <li><a href="formulairefrns.php">Fournisseurs</a></li>
          <li><a href="formdemande.php">Demandes</a></li>
          <li><a href="formreclamation.php">Reclamations</a></li>
        </ul>
      </div>
  



    <?php } ?>

</body>
</html>
