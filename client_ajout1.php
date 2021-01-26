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
		padding-bottom: 54px;
		background-color: white;
	}
	.separ{
		display: inline-block;
		padding-right: 40px;
		vertical-align: top;
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
	#valid{
		display: block;
		padding-top: 15px;
		
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
		echo("<form action='client_ajout2.php' method='POST' id='form'>");
		echo("<h3>Ajouter un client:</h3>\n");
		echo("<div class='separ'>");
		echo("<p>Nom :</p>");
		echo("<input type='text' name='nomc' size='30' /> ");
		echo("</div>");
		echo("<div class='separ'>");
		echo("<p> Prénom:</p>");
		echo("<input type='text' name='prenomc' size='30' /> ");
		echo("</div>");
		echo("<p> Adresse:</p>");
		echo("<input type='text' name='adres' size='75' /> ");
		echo("<div class='separ'>");
		echo("<p> Pays:</p>");
		echo("<input type='text' name='pays' size='20' /> ");
		echo("</div>");
		echo("<div class='separ'>");
		echo("<p> Code postal:</p>");
		echo("<input type='text' name='cod' size='12' /> ");
		echo("</div>");
		echo("<div class='separ'>");
		echo("<p> Téléphone:</p>");
		echo("<input type='text' name='telc' size='10' /><br/><br/>");
		echo("</div>");	
		echo("<div id='valid'>");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='infos_client' value='Ajouter' />");	
		echo("</div>");		
		echo("</form>");
		echo("</section>");
	}
?>

<?php
  include("footer.html");
?>
</body>
</html>
