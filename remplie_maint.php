<?php 
session_start();
if(isset($_SESSION['nom']) == 0){
	$_SESSION['nom'] = "";
	$_SESSION['num'] = "";
	$_SESSION['role'] = "";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>projet_info</title>
</head>
<style>
	section {
		margin:0px 200px 0px 200px;
		padding: 10px;
		padding-bottom: 144px;
		background-color: white;
	}
	textarea{
		height:100px;
		width:100%;
		resize:none
	}
	h3{
		border-bottom: 1px solid black;
	}
	.texte{
		display: inline-block;
		vertical-align: top;
		margin: 10px;
	}
	#valid{
		display: block;
		padding-top: 15px;
		
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		margin: 10px;
		border: 1px solid black;
		vertical-align: top;
		width:90%;
	}
	#deux {
		margin-bottom: 18px;
		margin-top: 18px;
	}
	#accuei {
		background-color: #DCDCDC;
		margin: 20px;
		border: 1px solid black;
	}
	#rediri {
		padding-top: 278px;
		text-align: center;
	}
</style>
<body>
<?php
/*\ [] {}*/
  include("header.php");
  require("connexion.inc.php");
?>
<?php
if($_SESSION["nom"] == ""){
	require("erreur_ident.php");
}else{
	echo("<section>\n");
	if(isset($_POST['remp']) &&  $_POST["pb"] != ""){
		$solu = $_POST["pb"];
		$id = $_POST["idinter"];
		$reqsolu = "UPDATE intervention SET solution = '$solu' WHERE codeinter = $id;";
		$reqfini = "UPDATE intervention SET fini = 1 WHERE codeinter = $id;";
		$rese = $pro->exec($reqsolu);
		$rese = $pro->exec($reqfini);
	}
	echo("<form action='remplie_maint.php' method='post' id='form'>\n");
	echo("<h3>Remplir une maintenance</h3>\n");
	echo("<p> maintenance a completer:</p>\n");
	echo("<select name='idinter'>");
	$datereq = date('Y/m/d');
	$requetcliun = "SELECT intervention.codeinter, intervention.dateinter, client.nomc, client.prenomc 
									from intervention, contrat, client 
									where intervention.numcontrat = contrat.numcontrat and contrat.idclient = client.idclient and intervention.fini = 0;";
	$rese = $pro->query($requetcliun);
	$rese->setFetchMode(PDO::FETCH_ASSOC);
	$ligne= $rese->fetch();
	/*\ [] {}*/
	if($ligne == null){
		echo("<option value='null'> Aucune maintenance en cour.</option>\n");
		echo("</select><br/><br/>\n");
		echo("</div>\n");
		echo("</form>\n");
	}else{
		$inter = $ligne['codeinter'];
		$date = $ligne['dateinter'];
		$nom = $ligne['nomc'];
		$precli = $ligne['prenomc'];
		echo("<option value='$inter'> $nom $precli $date</option>\n");
		while($ligne= $rese->fetch()){
			$inter = $ligne['codeinter'];
			$date = $ligne['dateinter'];
			$nom = $ligne['nomc'];
			$precli = $ligne['prenomc'];
			echo("<option value='$inter'> $nom $precli $date</option>\n");
		}
		echo("</select><br/><br/>\n");
		echo("</div>\n");
		echo("<p>Solution apporter:</p>\n");
		echo("<textarea name='pb'></textarea> <br/><br/>\n");
		echo("<div id='valid'>\n");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='remp' value='Remplir' />\n");
		echo("</div>\n");
		echo("</form>\n");
	}
	echo("</section>\n");
}
/*\ [] {}*/
?>
<?php
  include("footer.html");
?>
</body>
</html>
