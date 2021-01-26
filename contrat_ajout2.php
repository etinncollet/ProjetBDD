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
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		margin: 20px;
		border: 1px solid black;
		vertical-align: top;
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
	#com {
		background-color: #DCDCDC;
		border: 1px solid black;
		display: block;
		padding: 20px;
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
		if(isset($_POST['identifiantc']) && isset($_POST['datec'])){
			$id=$_POST['identifiantc'];
			$datedebut=$_POST['datec'];
			$datefin = date("Y-m-d", strtotime("$datedebut +1 year"));
			echo($datefin);
			echo($datedebut);
			$ajout = "INSERT INTO contrat(datedebut, datefin, idclient) ValUES ('$datedebut', '$datefin', $id);";
			$ex = $pro->exec($ajout);
			echo("<section>");
			echo("<div id='com'>");
			echo("<h3>Le contrat a bien été ajouté.</h3>");
			echo("<form action='contrat_ajout1.php' method='get'>");
			echo("<input type='submit' name='val' value='ok'/>");
			echo("</form>");
			echo("</div>");
			echo("</section>");
		}else{
			echo("<section>");
			echo("<div id='com'>");
			echo("<h3>Il y a une erreur dans la commande.</h3>");
			echo("<form action='contrat_ajout1.php' method='get'>");
			echo("<input type='submit' name='val' value='ok'/>");
			echo("</form>");
			echo("</div>");
			echo("</section>");
		}
	}
?>

<?php
  include("footer.html");
?>
</body>
</html>
