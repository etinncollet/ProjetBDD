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
	#tete {
		background-color: #DCDCDC;
		display: block;
		text-align: center;
		padding: 20px;
		border: 1px solid black;
	}
	thead {
		height: 60px; 
		background-color:#F1B164;
	}
	th{
		border: 1px solid black; 
		padding: 5px;
	}
	td{
		border: 1px solid black; 
	}
	tr{
		padding: 20px; 
	}
	table {
		text-align: center;
		width: 100%;
  	border-collapse: collapse;
  	padding: 20px;
  	border: 1px solid black;
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
		echo("<section>");
		echo("<h1 id='tete'>liste des facture:</h1>\n");
		echo("<table>");
		echo("<thead>");
		echo("<tr><th>Numéro facture</th><th>Date facture</th><th>Montant</th><th>Client</th><th>Detail</th></tr>");
		echo("</thead>");
		echo("<tbody>");
		$request = "SELECT numfacture, datefacture, montant, client.nomc, client.prenomc FROM acheter Natural join client;";
		$commande = $pro->query($request);
		$commande->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $commande->fetch()){
			$facture = $ligne["numfacture"];
			$date = $ligne["datefacture"];
			$montant = $ligne["montant"];
			$nom = $ligne["nomc"];	
			$prenom = $ligne["prenomc"];	
			echo("<tr> <th>$facture</th><td>$date</td><td>$montant</td><td>$nom $prenom</td><td><form action='detail_facture.php' method='get'><input type='submit' name='$facture' value='Detail'/></form></td></tr>");
		}
		echo("</tbody>");
		echo("</table>");		
		echo("</section>");
	}

  include("footer.html");
?>
</body>
</html>
