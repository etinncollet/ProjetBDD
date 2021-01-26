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
		echo("<h1>Faire une commande:</h1>");
		echo("<form action='commande_enregi.php' method='post' id='form'>");
		echo("<h3>Pièce existante:</h3>");
		echo("<p> Fournisseur:</p>");
		echo("<select name='fourni'>");
		$requetfour = "SELECT numSIRET, nomF FROM fournisseur;";
		$resf = $pro->query($requetfour);
		$resf->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $resf->fetch()){
			$numf = $ligne["numsiret"];
			$nomf = $ligne["nomf"];
			echo("<option value='$numf'> $nomf </option>\n");
		}
		echo("</select>");
		echo("<p> Pièce:</p>");
		echo("<select name='piece'> ");
		$requetmate = "SELECT idmat, libelle, prixachat FROM materiel;";
		$resm = $pro->query($requetmate);
		$resm->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $resm->fetch()){
			$numf = $ligne["idmat"];
			$nomf = $ligne["libelle"];
			$prix = $ligne["prixachat"];
			echo("<option value='$numf'> $nomf : &euro;$prix  </option>\n");
		}
		echo("</select>");
		echo("<p> Nombre:</p>");
		echo("<input type='text' name='nombre' size='10' /> <br/><br/>");
		echo("<input type='reset' name='reset' value='Effacer' /> ");
		echo("<input type='submit' name='enci' value='Commander' />");
		echo("</form>");
		
		echo("<form action='commande_enregi.php' method='POST' id='form'>");
		echo("<h3 id='deux' >Nouvelle pièce:</h3>");
		echo("<p> Fournisseur:</p>");
		echo("<select name='fourni'> ");
		$requetfour = "SELECT numSIRET, nomF FROM fournisseur;";
		$resf = $pro->query($requetfour);
		$resf->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $resf->fetch()){
			$numf = $ligne["numsiret"];
			$nomf = $ligne["nomf"];
			echo("<option value='$numf'> $nomf </option>\n");
		}
		echo("</select> ");
		echo("<p> Pièce:</p>");
		echo("<input type='text' name='piece' size='40' /> ");
		echo("<p>Type de la pièce:</p>");
		echo("<input type='text' name='typepie' size='30' /> ");
		echo("<p>Prix d'achat:</p>");
		echo("<input type='text' name='priachapie' size='10' /> ");
		echo("<p>Prix prévu de vente:</p>");
		echo("<input type='text' name='priventepie' size='10' /> ");
		echo("<p> Nombre:</p>");
		echo("<input type='text' name='nombre' size='10' /> <br/><br/>");
		echo("<input type='reset' name='reset' value='Effacer' /> ");
		echo("<input type='submit' name='nouv' value='Commander' />");
		echo("</form>");
		echo("</section>");
	}
?>

<?php
  include("footer.html");
?>
</body>
</html>
