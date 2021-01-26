<?php 
session_start(); 
if(isset($_SESSION['nom']) == 0){
	$_SESSION['nom'] = "";
	$_SESSION['num'] = "";
	$_SESSION['role'] = "";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Formulaire de saisie d'une personne</title>
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
	}
	td{
		border: 1px solid black; 
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
	$reqstock = "SELECT materiel.libelle, materiel.type, materiel.prixvente, materiel.stock FROM materiel";
	echo("<section>");
	echo("<h1 id='tete'>Voici le stock actuel:</h1>");
	echo("<table>");
	echo("<thead>");
	echo("<tr><th>libelle</th><th>type</th><th>montant uniter</th><th>quantiter</th></tr>");
	echo("</thead>");
	echo("<tbody>");
	$resm = $pro->query($reqstock);
	$resm->setFetchMode(PDO::FETCH_ASSOC);
	while($ligne= $resm->fetch()){
		$lib = $ligne['libelle'];
		$type = $ligne['type'];
		$prix = $ligne['prixvente'];
		$stock = $ligne['stock'];
		if($stock <= 10){
				echo("<tr class='manque'> <th>$lib</th><td>$type</td><td>$prix</td><td>$stock</td> </tr>");
		}else{
				echo("<tr> <th>$lib</th><td>$type</td><td>$prix</td><td>$stock</td> </tr>");
		}
	}
	echo("</tbody>");
	echo("</table>");

	echo("</section>");
}
?>
<?php
include("footer.html");
?>
</body>
</html>
