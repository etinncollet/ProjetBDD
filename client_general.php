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
		text-align: center;
	}
	.option {
		background-color:#F1B164;
		display: inline-block;
		padding: 10px;
		margin: 50px 20px 0px 20px;
		height:300px;
		vertical-align:top;
		color: black;
	}
	.bot {
		width:300px;
		display: inline-block;
	}
	.choix {
		padding-bottom: 40px;
		border-bottom: 1px solid black;
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 50px;
		border: 1px solid black;
	}
	#accuei {
		background-color: #DCDCDC;
		margin: 20px;
		border: 1px solid black;
	}
	#rediri {
		padding-top: 278px;
	}
</style>
<body>
<?php
/*\ [] {}*/
  include("header.php");
?>
<?php
/*\ [] {}*/
if($_SESSION['role'] == ""){
	require("erreur_ident.php");
}else{
	if($_SESSION['role'] == "PDG" || $_SESSION['role'] == "administratif" ){
		echo("<section>");
		echo("<a href='client_modif.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des clients</h4>");
		echo("<p>Cette partie permet d'ajouter de nouveaux clients, de facturer un client ou de modifier les informations des clients déjà existants.</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='contrat_ajout1.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des contrats</h4>");
		echo("<p>Cette partie permet de gérer les contrats des clients : d'en ajouter ou d'en enlever.</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='voir.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder sans pouvoir modifier les clients, leurs commandes et leurs contrats.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}elseif($_SESSION['role'] == "responsable technique"){
		echo("<section>");
		echo("<a href='voir.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder sans pouvoir modifier les clients, leurs commandes et leurs contrats.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}else{
		echo("<section id='rediri'>");
		echo("<div id='form'>");
		echo("<h1>Vous n'avez pas accès à cette partie.</h1>");
		echo("<p>Cette partie est reservée aux personnes étant PDG, administrateurs ou responsables techniques. Si vous ne faites pas partie de ces categories, retourneé a l'accueil.</p>");
		echo("<a href='corp.php' class='button' id='accuei'>Retourner a l'accueil</a>");
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
