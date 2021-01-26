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
		echo("<h1 id='tete'>liste des contrat:</h1>\n");
		echo("<table>");
		echo("<thead>");
		echo("<tr><th>Numéro contrat</th><th>Date début</th><th>Date fin</th><th>Client</th> </tr>");
		echo("</thead>");
		echo("<tbody>");
		$requestc = "SELECT numcontrat, datedebut, datefin, client.nomc, client.prenomc FROM contrat natural join client;";
		$contrate = $pro->query($requestc);
		$contrate -> setFetchMode(PDO::FETCH_ASSOC);
		while($ligne = $contrate->fetch()){
			$contrat = $ligne["numcontrat"];
			$debut = $ligne["datedebut"];
			$fin = $ligne["datefin"];
			$nom = $ligne["nomc"];
			$prenom = $ligne["prenomc"];
			echo("<tr> <th>$contrat</th><td>$debut</td><td>$fin</td><td>$nom $prenom</td> </tr>");
		}		
		echo("</tbody>");
		echo("</table>");
		echo("</section>");
	}
  include("footer.html");
?>
</body>
</html>
