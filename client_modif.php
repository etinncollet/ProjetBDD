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
	echo("<section>");
	echo("<a href='client_ajout1.php' class='bot'>");
	echo("<div class='option'>");
	echo("<h4 class='choix'>Ajouter des clients</h4>");
	echo("<p>Cette partie permet d'ajouter de nouveaux clients.</p>");
	echo("</div>");
	echo("</a>");
	echo("<a href='client_nom.php' class='bot'>");
	echo("<div class='option'>");
	echo("<h4 class='choix'>Mettre à jour des clients.</h4>");
	echo("<p>Cette partie permet de modifier les informations des clients </p>");
	echo("</div>");
	echo("</a>");
	echo("<a href='client_facturation.php' class='bot'>");
	echo("<div class='option'>");
	echo("<h4 class='choix'>Facturation</h4>");
	echo("<p>Cette partie permet de faire une facture a un client</p>");
	echo("</div>");
	echo("</a>");
	echo("</section>");
}
?>
<?php
  include("footer.html");
?>
</body>
</html>
