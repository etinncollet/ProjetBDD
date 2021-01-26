<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>projet_header</title>
</head>
  <style>
    body {
      margin: 0px;
      background-color: #DCDCDC;
    }

    img {
      vertical-align: middle;
      float: left;
      display: inline-block;
    }

    .nom {
      text-align: center;
      background-color: #DCDCDC;
      margin: 0px;
      padding: 30px;
      font-size: 60px;
      border-bottom: 2px solid black;
    }

    .button {
    background-color: #F1B164;
    color: black;
    padding: 10px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 0px;
    /*cursor: pointer;*/
    border-right: 1px solid black;
    }

    .bout{
    font-size : 0;
    margin: 0px;
    background-color: #F1B164;
    border-bottom: 2px solid black;
    }    
    .deroulant {
		  background-color: #F1B164;
		  color: black;
		  padding: 10px 24px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 20px;
		  margin: 0px;
		  cursor: pointer;
		  border-right: 1px solid black;
    }
    #enre {
			display: inline-block;
      float: right;
      border-left: 1px solid black;
    }
		#ide {
      margin: 0px;
      float: right;
      display: inline-block;
      padding: 24px 10px;
      font-size: 20px;
    }
		header {
			position: fixed;
			width: 100%;
		}
		section {
			padding-top: 200px;
		}
  </style>
<body>
  <header>

    <img src="logsecu2sf.png"
     width="140"
     height="131"
     alt="">
     <h1 class="nom" >SECURIT 
				<p id="ide">
				<?php
					/*\ [] {}*/
					$nomuti = $_SESSION["nom"];
					echo("$nomuti");
				?>
				</p> 
			</h1>
    <div class="bout">
      <a href="corp.php" class="button">accueil</a>
      <a href="materiel_general.php" class="button">materiel</a>
      <a href="client_general.php" class="button">clients</a>
      <a href="employer_general.php" class="button">employés</a>
			<a href="intervention_general.php" class="button">interventions</a>
      <a href="formu_ident.php" class="button" id="enre">
      <?php
      	if($_SESSION['nom'] != ""){
      		echo("Deconnexion");
      	}else{
      		echo("identifiez-vous");
      	}
      ?>
      </a>
    </div>
  </header>
</body>
</html>
