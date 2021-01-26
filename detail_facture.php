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
	form {
		background-color:#F1B164;
		display: block;
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
	#tete {
		background-color: #DCDCDC;
		display: block;
		text-align: center;
		padding: 20px;
		border: 1px solid black;
	}
	thead {
		height: 60px; 
		background-color:#F1B164;
	}
	th{
		border: 1px solid black; 
		padding: 5px;
	}
	td{
		border: 1px solid black; 
	}
	tr{
		padding: 20px; 
	}
	table {
		text-align: center;
		width: 100%;
  	border-collapse: collapse;
  	padding: 20px;
  	border: 1px solid black;
	}
	h3{
		border-bottom: 1px solid black;
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
		echo("<h1 id='tete'>detail de la facture:</h1>\n");
		echo("<form action='commandes_visu.php' method='get'>\n");
		
		$request = "SELECT numfacture FROM acheter;";
		$commande = $pro->query($request);
		$commande->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne = $commande->fetch()){
			$num = $ligne["numfacture"];
			if(isset($_GET["$num"])){
				$idfact = $num;
			}
		}
		
		$reqmat = "SELECT libelle, prixvente, quantite FROM vendre, materiel where materiel.idmat = vendre.idmat and numfacture = $idfact;";
		$reqach = "SELECT numfacture, datefacture, montant, codeinstall, nomc, prenomc FROM acheter natural join client where numfacture = $idfact;";
		$mat = $pro->query($reqmat);
		$mat ->setFetchMode(PDO::FETCH_ASSOC);
		$com = $pro->query($reqach);
		$com ->setFetchMode(PDO::FETCH_ASSOC);
		
		$ligne = $com->fetch();
		$facture = $ligne["numfacture"];
		$date = $ligne["datefacture"];
		$montant = $ligne["montant"];
		$code = $ligne["codeinstall"];	
		$nom = $ligne["nomc"];	
		$prenom = $ligne["prenomc"];
		
		echo("<h3>Facture numero $facture :</h3>\n");
		echo("<h4>du: $date</h4>\n");
		echo("<h4>de: $montant euros</h4>\n");
		echo("<h4>a: $nom $prenom</h4>\n");
		if($code == null){
			echo("<h4>Pas d'installation a faire</h4>\n");
		}else{
			if($code == -1){
				echo("<h4>Installation comprise mais pas encore enregistrer</h4>\n");
			}else{
				echo("<h4>Installation comprise</h4>\n");
			}
		}

		echo("<table>");
		echo("<table>");
		echo("<thead>");
		echo("<tr><th>Article</th><th>prix</th><th>Nombre</th><th>Total</th></tr>");
		echo("</thead>");
		echo("<tbody>");
		/*\ [] {}*/
		$somm = 0;
		while($ligne= $mat->fetch()){
			$nomar = $ligne["libelle"];
			$prix = $ligne["prixvente"];
			$nbr = $ligne["quantite"];
			$tot = $nbr * $prix;
			$somm += $tot;
			echo("<tr> <th>$nomar</th><td>$prix</td><td>$nbr</td><td>$tot</td></tr>");
		}
		
		if($code != null){
			$inst = $somm * 0.2; 
			$somm += $inst;
			echo("<tr> <th></th><td></td><td>installation :</td><td>$inst</td></tr>");
		}
		echo("<tr> <th></th><td></td><td>Total :</td><td>$somm</td></tr>");
		
		echo("</tbody>");
		echo("</table>");		
		echo("<br/><input type='submit' name='ret' value='retour'/>\n");
		echo("</form>\n");
		echo("</section>");
	}

  include("footer.html");
?>
</body>
</html>
