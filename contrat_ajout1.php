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
		height: 460px;
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
		echo("<form action='contrat_ajout2.php' method='POST' id='form'>");
		echo("<h3>Ajouter un contrat:</h3>\n");
		echo("<div class='separ'>");
		echo("<p>Identifiant du client:</p>");
		echo("<select name='identifiantc'>");
		$reqcli = "select idclient, nomc, prenomc from client;";
		$client = $pro->query($reqcli);
		$client->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne = $client->fetch()){
			$id = $ligne['idclient'];
			$nom = $ligne['nomc'];
			$pren = $ligne['prenomc'];
			echo("<option value='$id'> $nom $pren </option>");
		}
		echo("</select>");
		echo("</div>");
		
		$date=date("Y-m-d", strtotime("+2 year"));
		echo("<p> Date de début du contrat:</p>");
		echo("<input type='date' id='start' name='datec' min='2000-01-01' max='$date' /> ");
		echo("<div class='separ'>");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='infos_contrat' value='Ajouter' />");	
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
