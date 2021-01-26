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
	}
	textarea{
		height:100px;
		width:100%;
		resize:none
	}
	#h3{
		border-bottom: 1px solid black;
		margin-bottom: 10px;
	}
	.texte{
		display: inline-block;
		vertical-align: top;
		margin: 10px;
	}
	#valid{
		display: block;
		padding-top: 15px;
		
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		margin: 10px;
		border: 1px solid black;
		vertical-align: top;
		width:90%;
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
	table {
		text-align: center;
		width: 100%;
  	border-collapse: collapse;
  	padding: 20px;
	}
	#info{
		display: block;
		background-color: #DCDCDC;
		padding: 20px;
		border: 1px solid black;
		margin: 10px;
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
	echo("<section>\n");
	if(isset($_POST['remp'])){
		$aujour = date('Y-m-d');
		$requetcliun = "SELECT idmat, prixvente from materiel;";
		$rese = $pro->query($requetcliun);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		/*\ [] {}*/
		$article = array();
		$total = 0;
		$cli = $_POST["idinter"];
		while($ligne = $rese->fetch()){
			$int = $ligne['idmat'];
			$pri = $ligne['prixvente'];
			if($_POST["$int"] != ""){
				$article["$int"] = $_POST["$int"];
				$total += ($article["$int"] * $pri);
			}
		}
		if(isset($_POST["install"])){
			$total *= 1.2;
			$reqinter = "INSERT INTO acheter (dateFacture, montant, idClient, codeInstall) VALUES ('$aujour',$total, $cli, -1) RETURNING numfacture;";
		}else{
			$reqinter = "INSERT INTO acheter (dateFacture, montant, idClient) VALUES ('$aujour',$total, $cli) RETURNING numfacture;";
		}
		$rese = $pro->query($reqinter);
		$ligne = $rese->fetch();
		$idf = $ligne["numfacture"];
		foreach($article as $cle => $val){
			$reqvent = "INSERT INTO vendre VALUES($cle, $idf, $val);";
			$rese = $pro->exec($reqvent);
		}
		if(isset($_POST["install"])){
			echo("<div id='info'>");
			echo("cette facture a bien ete rentrer vous pouvez allez faire le detail de l'installation ou rester ici<br/><br/>");
			echo("<form action='gestion_interve.php' method='POST'>");
			echo("<input type='submit' name='$idf' value='aller' />");
			echo("</form>");
			echo("</div>");		
		}else{
			echo("<div id='info'>");
			echo("cette facture a bien ete rentrer <br/><br/>");
			echo("<form action='client_facturation.php' method='POST'>");
			echo("<input type='submit' name='val' value='ok' />");
			echo("</form>");
			echo("</div>");		
		}

		
	}
	
	echo("<form action='client_facturation.php' method='post' id='form'>\n");
	echo("<h3 id='h3'>facturer</h3>\n");
	echo("<div id='h3'>\n");
	echo("<p>Client:</p>\n");
	echo("<select name='idinter'>");
	$requetcliun = "SELECT idclient, nomc, prenomc from client;";
	$rese = $pro->query($requetcliun);
	$rese->setFetchMode(PDO::FETCH_ASSOC);
	$ligne= $rese->fetch();
	/*\ [] {}*/
	while($ligne= $rese->fetch()){
		$int = $ligne['idclient'];
		$nom = $ligne['nomc'];
		$precli = $ligne['prenomc'];
		echo("<option value='$int'> $nom $precli </option>\n");
	}
	echo("</select><br/><br/>\n");
	echo("</div>\n");
	
	echo("<div id='h3'>\n");
	echo("<table>");
	echo("<thead>");
	echo("</thead>");
	echo("<tbody>");

	$requetc = "SELECT idmat, libelle, prixvente from materiel;";
	$rese = $pro->query($requetc);
	$rese->setFetchMode(PDO::FETCH_ASSOC);
	/*\ [] {}*/
	while($ligne= $rese->fetch()){
		$int = $ligne['idmat'];
		$nom = $ligne['libelle'];
		$prix = $ligne['prixvente'];
		echo("<tr> <th>$int</th><td>$nom</td><td>$prix</td><td><input type='number' id='$int' name='$int' min='0' max='1000'></td></tr>");
	}
	
	echo("</tbody>");
	echo("</table>");
	echo("</div>\n");
	
	echo("<div id='h3'>\n");
	echo("<input type='checkbox' id='in' name='install'>");
  echo("<label for='in'>Faire une Installation</label>");
  echo("</div>\n");
  
	echo("<div id='valid'>\n");
	echo("<input type='reset' name='reset' value='Annuler' />\n");
	echo("<input type='submit' name='remp' value='Commander' />\n");
	echo("</div>\n");
	echo("</form>\n");
	echo("</section>\n");
}
/*\ [] {}*/
?>
<?php
  include("footer.html");
?>
</body>
</html>
