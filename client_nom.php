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
		padding-bottom: 88px;
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
	.separ{
		display: inline-block;
		padding-right: 40px;
		vertical-align: top;
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
/*\ [] {}*/
if($_SESSION['role'] == ""){
	require("erreur_ident.php");
}else{
		echo("<section>");
		echo("<form action='client_nom2.php' method='POST' id='form'>");
		echo("<h3>Choisisser le client puis modifier une ou les deux des informations</h3>");
		echo("<select name='idc'>");
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
		echo("<p>numéro de téléphone:</p>");
		echo("<input type='text' name='telephone' size='10' /> <br/><br/>");
		echo("</div>");
		echo("<div id='valid'>");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='modif_client' value='Modifier' />");	
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
