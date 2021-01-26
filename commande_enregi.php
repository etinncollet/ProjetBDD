<?php 
session_start(); 
if(isset($_SESSION['nom']) == 0){
	$_SESSION['nom'] = "";
	$_SESSION['num'] = "";
	$_SESSION['role'] = "";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Formulaire de saisie d'une personne</title>
</head>
<style>
	section {
		margin:0px 200px 0px 200px;
		padding: 10px;
		padding-bottom: 200px;
		background-color: white;
	}
	#com {
		background-color: #DCDCDC;
		border: 1px solid black;
		display: block;
		padding: 20px;
		text-align: center;
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		border: 1px solid black;
		vertical-align: top;
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
		width: 90%;
  	border-collapse: collapse;
  	margin: 20px;
  	border: 1px solid black;
	}
	th {
		height: 40px; 
	}
</style>
<body>
<?php
/*\ [] {} ||*/
require("connexion.inc.php");
include("header.php");

if($_SESSION["nom"] == ""){
	require("erreur_ident.php");
}else{
	if(isset($_GET['annul']) == 1){
		echo("hello2");
		print_r($_GET);
	}else{
		if(isset($_POST["enci"]) && isset($_POST["nombre"]) && isset($_POST["piece"]) && isset($_POST["fourni"]) && $_POST["nombre"] != ""){
			$nbr = $_POST["nombre"];
			if($nbr != ""){
				$numpie = $_POST["piece"];
				echo("<section>");
				echo("<div id='com'>");
				echo("<h4>Nouvelle commande</h4>");
				/*echo("<p>cette piece a ete commander voulez vous annuler</p>");*/
				echo("<p>Cette commande a bien été passée.</p>");
				$requetmate = "SELECT libelle, prixachat FROM materiel WHERE idmat = $numpie;";
				$resm = $pro->query($requetmate);
				$resm->setFetchMode(PDO::FETCH_ASSOC);
				$ligne= $resm->fetch();
				$nomf = $ligne["libelle"];
				$prix = $ligne["prixachat"];
				$tot = $prix * $nbr;
				echo("<table>");
				echo("<thead>");
				echo("<tr><th>libelle</th><th>nombre</th><th>montant uniter</th><th>montant total</th> </tr>");
				echo("</thead>");
				echo("<tbody>");
				echo("<tr> <th>$nomf</th><td>$nbr</td><td>$prix</td><td>$tot</td> </tr>");
				echo("</tbody>");
				echo("</table>");
				$reqajou = "UPDATE materiel SET stock = stock + $nbr WHERE idmat = $numpie;";
				$resa = $pro->exec($reqajou);
				$for = $_POST["fourni"];
				$datauj = date('d/m/Y H:i:s');
				$reqsup = "INSERT INTO fournir VALUES ($numpie, $for, '$datauj');";
				$ress = $pro->exec($reqsup);
				echo("<form action='materiel_commande.php' method='get'>");
				echo("<input type='submit' name='annul' value='ok'/>");
				echo("</form>");
				echo("</div>");
				echo("</section>");
			}
		}elseif(isset($_POST["nouv"]) == 1 && $_POST['priventepie'] && $_POST['nombre'] && $_POST['priachapie'] && $_POST['typepie'] && $_POST['piece'] && isset($_POST["fourni"]) == 1){
			$nbr = $_POST["nombre"];
			if($nbr != ""){
				$numpie = $_POST["piece"];
				echo("<section>");
				echo("<div id='com'>");
				echo("<h4>Nouvelle commande</h4>");
				/*echo("<p>cette piece a ete commander voulez vous annuler</p>");*/
				echo("<p>Cette commande a bien été passée.</p>");
				$piecev = $_POST['priventepie'];
				$nbrm = $_POST['nombre'];
				$piecea = $_POST['priachapie'];
				$typemat = $_POST['typepie'];
				$npiece = $_POST['piece'];
				$tot = $piecea * $nbrm;
				echo("<table>");
				echo("<thead>");
				echo("<tr><th>libelle</th><th>type</th><th>nombre</th><th>montant uniter achat</th><th>montant uniter vente</th><th>montant total</th> </tr>");
				echo("</thead>");
				echo("<tbody>");
				echo("<tr> <th>$npiece</th><td>$typemat</td><td>$nbrm</td><td>$piecea</td><td>$piecev</td><td>$tot</td></tr>");
				echo("</tbody>");
				echo("</table>");
				$reqajou = "INSERT INTO materiel (libelle, prixachat, prixvente, type, stock) VALUES ('$npiece', $piecea, $piecev, '$typemat', $nbrm) RETURNING idmat;";
				$resa = $pro->query($reqajou);
				$resa->setFetchMode(PDO::FETCH_ASSOC);
				$ligne = $resa->fetch();
				$numpie = $ligne['idmat'];
				$forn = $_POST['fourni'];
				$datauj = date('d/m/Y H:i:s');
				$reqsup = "INSERT INTO fournir VALUES ($numpie, $forn, '$datauj');";
				$ress = $pro->exec($reqsup);
				echo("<form action='materiel_commande.php' method='get'>");
				echo("<input type='submit' name='val' value='ok'/>");
				echo("</form>");
				echo("</div>");
				echo("</section>");
			}
		}else{
			echo("<section>");
			echo("<div id='com'>");
			echo("<h3>Il y a eu une erreur dans la commande</h3>");
			echo("<form action='materiel_commande.php' method='get'>");
			echo("<input type='submit' name='val' value='ok'/>");
			echo("</form>");
			echo("</div>");
			echo("</section>");
		}
	}
}
?>
<?php
include("footer.html");
?>
</body>
</html>
