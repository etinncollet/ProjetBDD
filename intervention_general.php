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
	if($_SESSION['role'] == "employe" ){
		echo("<section>");
		echo("<a href='regard_intervention.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder les interventions en cours et celles prévues. Aucune modification n'est possible<br/>(maintenance ou installation).</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='remplie_maint.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Remplir une maintenance</h4>");
		echo("<p>Cette partie permet de remplir les descriptifs de maintenance par les employés qui en étaient chargés.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}elseif($_SESSION['role'] == "PDG"){
		echo("<section>");
		echo("<a href='gestion_interve.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des interventions</h4>");
		echo("<p>Cette partie permet d'ajouter de nouvelles interventions à faire et valider la fin de celles en cours<br/>(maintenance ou instalation).</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='regard_intervention.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder les interventions en cours et celles prévues. Aucune modification n'est possible<br/>(maintenance ou instalation).</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='remplie_maint.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Remplir une maintenance</h4>");
		echo("<p>Cette partie permet de remplir les descriptifs de maitenance par les employés qui en étaient chargé.</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}elseif($_SESSION['role'] == "responsable technique"){
		echo("<section>");
		echo("<a href='gestion_interve.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Gestion des interventions</h4>");
		echo("<p>Cette partie permet d'ajouter de nouvelles interventions à faire et valider la fin de celles en cours<br/>(maintenance ou instalation).</p>");
		echo("</div>");
		echo("</a>");
		echo("<a href='regard_intervention.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder les interventions en cours et celles prévues. Aucune modification n'est possible<br/>(maintenance ou instalation).</p>");
		echo("</div>");
		echo("</a>");
		echo("</section>");
	}else{
		echo("<section id='rediri'>");
		echo("<a href='regard_intervention.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Regarder</h4>");
		echo("<p>Cette partie permet de regarder les interventions en cours et celles prévues. Aucune modification n'est possible<br/>(maintenance ou instalation).</p>");
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
