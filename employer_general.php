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
	if($_SESSION['role'] == "PDG"){
		echo("<section>");
		echo("<a href='gestion_employe.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des employés</h4>");
		echo("<p>Cette partie permet d'ajouter de nouveaux salariés ou de modifier leur statut et leurs informations.</p>");
		echo("</div>");
		echo("</a>");
		/*echo("<a href='gestion_equipe.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des équipes</h4>");
		echo("<p>Cette partie permet de gérer ou créer des équipes et leurs membres.</p>");
		echo("</div>");*/
		echo("</a>");
		echo("<a href='regard_employer.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder sans pouvoir modifier les employés, leur rôle, les équipes dans lesquelles ils sont et les dossiers qu'ils gerent.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}elseif($_SESSION['role'] == "administratif" || $_SESSION['role'] == "responsable technique"){
		echo("<section>");
		/*echo("<a href='gestion_equipe.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des équipes</h4>");
		echo("<p>Cette partie permet de gérer ou créer des équipes et leurs membres.</p>");
		echo("</div>");*/
		echo("</a>");
		echo("<a href='regard_employer.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder sans pouvoir modifier les employés, leur rôle, les équipes dans lesquelles ils sont et les dossiers qu'ils gerent.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}else{
		echo("<section>");
		echo("<a href='regard_employer.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder sans pouvoir modifier les employés, leur rôle, les équipes dans lesquelles ils sont et les dossiers qu'ils gerent.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}
}
?>
<?php
  include("footer.html");
?>
</body>
</html>
