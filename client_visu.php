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
		padding: 10px; 
	}
	table {
		text-align: center;
		width: 100%;
  	border-collapse: collapse;
  	padding: 10px;
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
		echo("<h1 id='tete'>liste des clients:</h1>\n");
		echo("<table>");
		echo("<thead>");
		echo("<tr><th>Client</th><th>Adresse</th><th>Téléphone</tr></tr>");
		echo("</thead>");
		echo("<tbody>");
		$request = "SELECT idclient, nomc, prenomc, adressec, telc FROM client;";
		$client = $pro->query($request);
		$client->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne = $client->fetch()){
			$id = $ligne["idclient"];
			$nom = $ligne["nomc"];
			$prenom = $ligne["prenomc"];
			$adresse = $ligne["adressec"];
			$tel = $ligne["telc"];
			echo("<tr><td>$nom $prenom</td><td>$adresse</td><td>$tel</td></tr>");
		}
		echo("</tbody>");
		echo("</table>");
		echo("</section>");
	}

  include("footer.html");
?>
</body>
</html>
