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
		padding-bottom: 200px;
		background-color: white;
	}
	#com {
		background-color: #DCDCDC;
		border: 1px solid black;
		display: block;
		padding: 20px;
		text-align: center;
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		border: 1px solid black;
		vertical-align: top;
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
	table {
		text-align: center;
		width: 100%;
  	border-collapse: collapse;
  	padding: 20px;
  	border: 1px solid black;
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
	.manque{
		background-color: red;
	}
</style>
<body>
<?php
/*\ [] {} ||*/
require("connexion.inc.php");
include("header.php");

if($_SESSION["nom"] == ""){
	require("erreur_ident.php");
}else{
	$reqemp = "SELECT * FROM employes";
	echo("<section>");
	echo("<h1 id='tete'>LISTE DES EMPLOYES DE L'ENTREPRISE:</h1>");
	echo("<table>");
	echo("<thead>");
	echo("<tr><th>Nom</th><th>Prénom</th><th>Role</th><th>Identifiant</th><th>Mot de passe</th></tr>");
	echo("</thead>");
	echo("<tbody>");
	$resm = $pro->query($reqemp);
	$resm->setFetchMode(PDO::FETCH_ASSOC);
	while($ligne= $resm->fetch()){
		$nome = $ligne['nome'];
		$prenome = $ligne['prenome'];
		$role = $ligne['role'];
		$ident = $ligne['identifiant'];
		if($ident == null){
				$ident = 'vide';
		}
		if($_SESSION['role'] == 'PDG'){
			$mdp = $ligne['motdepasse'];
			if($mdp == null){
				$mdp = 'vide';
			}
		}else{
			$mdp = "invisible";
		}
			echo("<tr> <th>$nome</th><td>$prenome</td><td>$role</td><td>'$ident'</td><td>'$mdp'</td></tr>");
	}
	echo("</tbody>");
	echo("</table>");

	echo("</section>");
}
include("footer.html");
?>
</body>
</html>
