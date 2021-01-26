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
	if($_SESSION['role'] == "PDG" OR $_SESSION['role'] == "administratif"){
		echo("<section>\n");
		echo("<a href='materiel_commande.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Commander</h4>");
		echo("<p>Cette partie est accessible uniquement aux administrateurs : elle sert a commander le matériel.</p>");
		echo("</div>");
		echo("</a>\n");
		echo("<a href='voir_stock.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Stocks</h4>");
		echo("<p>Cette partie permet aux membres de l'entreprise de consulter les stocks.</p>");
		echo("</div>");
		echo("</a>\n");
		/*n'est pas utile pour le moment
		echo("<a href='corp.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Fournisseur</h4>");
		echo("<p>Cette partie permet d'avoir les informations des differents fournisseurs de l'entrprise.</p>");
		echo("</div>");
		echo("</a>");*/
		echo("</section>\n");
	}else{
		echo("<section>\n");
		echo("<a href='voir_stock.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Stocks</h4>");
		echo("<p>Cette partie permet aux membres de l'entreprise de consulter les stocks.</p>");
		echo("</div>");
		echo("</a>\n");
		/*n'est pas utile pour le moment
		echo("<a href='corp.php' class='bot'>");
		echo("<div class='option'>");
		echo("<h4 class='choix'>Fournisseur</h4>");
		echo("<p>Cette partie permet d'avoir les informations des differents fournisseurs de l'entrprise.</p>");
		echo("</div>");
		echo("</a>");*/
		echo("</section>\n");
	}
}
?>
<?php
  include("footer.html");
?>
</body>
</html>