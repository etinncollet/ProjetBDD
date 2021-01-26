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
		width:300px;
		resize:none
	}
	h3{
		border-bottom: 1px solid black;
	}
	.gauche{
		display: inline-block;
		width:230px;
	}
	.droite{
		display: inline-block;
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
		width:93%;
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
		echo("<section>\n");
		if(isset($_POST["install"])){
			if(isset($_POST["respon"]) && isset($_POST["client"])){
				$js = $_POST["jour"];
				$ms = $_POST["mois"];
				$an = $_POST["annee"];
				$datett = "$an" . "/$ms/" . "$js";
				if($datett > date('Y/m/d')){
					$requetemploy = "SELECT numsecu, nome, prenome FROM employes WHERE role = 'employe';";
					$rese = $pro->query($requetemploy);
					$rese->setFetchMode(PDO::FETCH_ASSOC);
					$tabparti = [];
					$compte = 0;
					while($ligne= $rese->fetch()){
						$num = $ligne["numsecu"];
						$nome = $ligne["nome"];
						$prenome = $ligne["prenome"];
						if(isset($_POST["$num"])){
							$tabparti[$compte] = "$num";
							$compte += 1;
						}
					}
					$respon = $_POST["respon"];
					$reqinsert = "INSERT INTO installation (dateinstall, responsable) VALUES('$datett', '$respon')RETURNING codeinstall;";
					$rese = $pro->query($reqinsert);
					$rese->setFetchMode(PDO::FETCH_ASSOC);
					$ligne = $rese->fetch();
					$install = $ligne['codeinstall'];
					for($i=0; $i < $compte; $i++){
						$secu = $tabparti[$i];
						$reqequi = "INSERT INTO formerEquipe VALUES($install, '$secu');";
						$rese = $pro->exec($reqequi);
					}
					$fact = $_POST["client"];
					$reqmod = "UPDATE acheter SET codeinstall = '$install' WHERE numfacture = '$fact';";
					$rese = $pro->exec($reqmod);
				}
				/*\ [] {}*/
			}
		
		}elseif(isset($_POST["mainte"])){
		
			if(isset($_POST["pb"]) && isset($_POST["client_ctr"]) && $_POST["pb"] != ""){
				$js = $_POST["jour"];
				$ms = $_POST["mois"];
				$an = $_POST["annee"];
				$datett = "$an" . "/$ms/" . "$js";
				echo($datett);
				echo(date('Y/m/d'));
				if($datett > date('Y/m/d')){
					$requetemploy = "SELECT numsecu, nome, prenome FROM employes WHERE role = 'employe';";
					$rese = $pro->query($requetemploy);
					$rese->setFetchMode(PDO::FETCH_ASSOC);
					$tabparti = [];
					$compte = 0;
					while($ligne= $rese->fetch()){
						$num = $ligne["numsecu"];
						$nome = $ligne["nome"];
						$prenome = $ligne["prenome"];
						if(isset($_POST["$num"])){
							$tabparti[$compte] = "$num";
							$compte += 1;
						}
					}
					$ncontrat = $_POST["client_ctr"];
					$texte = $_POST["pb"];
					$appel = date('Y/m/d');
					$reqinsert = "INSERT INTO intervention (dateappel, probleme, dateinter, solutions, fini, numcontrat) VALUES('$appel', '$texte', '$datett', '', 0, $ncontrat)RETURNING codeinter;";
					$rese = $pro->query($reqinsert);
					$rese->setFetchMode(PDO::FETCH_ASSOC);
					$ligne = $rese->fetch();
					$inter = $ligne['codeinter'];
					for($i=0; $i < $compte; $i++){
						$secu = $tabparti[$i];
						$reqequi = "INSERT INTO faire VALUES($inter, '$secu');";
						$rese = $pro->exec($reqequi);
					}
				}
				/*\ [] {}*/
			}
			
		}

		
		echo("<h1>Gestion des interventions de l'entreprise:</h1>\n");
		
		echo("<form action='gestion_interve.php' method='post' id='form'>\n");
		echo("<h3>Maintenance:</h3>\n");
		
		echo("<div class='texte'>\n");
		echo("<p> Client:</p>\n");
		
		echo("<select name='client_ctr'>");
		$datereq = date('Y/m/d');
		$requetcliun = "SELECT numcontrat, nomc, prenomc FROM client, contrat WHERE client.idclient = contrat.idclient AND contrat.datefin > '$datereq' AND contrat.datedebut < '$datereq' ;";
		$rese = $pro->query($requetcliun);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		$ligne= $rese->fetch();
		if(isset($ligne["nomc"]) == 0){
			echo("<option value='null'> Aucun client ne peut avoir de maintenance.</option>\n");
			echo("</select><br/><br/>\n");
			echo("</div>\n");
			echo("</form>\n");
		}else{
			$num = $ligne["numcontrat"];
			$nomc = $ligne["nomc"];
			$prenomc = $ligne["prenomc"];
			echo("<option value='$num'> $nomc $prenomc </option>\n");
			while($ligne= $rese->fetch()){
				$num = $ligne["idclient"];
				$nomc = $ligne["nomc"];
				$prenomc = $ligne["prenomc"];
				echo("<option value='$num'> $nomc $prenomc </option>\n");
			}
			echo("</select><br/><br/>\n");
			/*\ [] {}*/
			echo("<p> Problème:</p>\n");
			echo("<textarea name='pb'></textarea> <br/><br/>\n");

			echo("<p> Date prévue de l'intervention(j/m/a):</p>\n");
			echo("<select name='jour'>\n");
			for($i=1; $i < 32; $i++){
				echo("<option value='$i'> $i </option>\n");
			}
			echo("</select>\n");
			echo("<select name='mois'>\n");
			for($i=1; $i < 13; $i++){
				echo("<option value='$i'> $i </option>\n");
			}
			echo("</select>\n");
			$det = date('Y');
			echo("<select name='annee'>\n");
			for($i=0; $i < 3; $i++){
				$ann = $det + $i;
				echo("<option value='$ann'> $ann </option>\n");
			}
			echo("</select>\n");		
			
			echo("</div>\n");
			echo("<div class='texte'>\n");
			echo("<p> Employé pour l'intervention:</p>\n");
			
			$requetemploy = "SELECT numsecu, nome, prenome FROM employes WHERE role = 'employe';";
			$rese = $pro->query($requetemploy);
			$rese->setFetchMode(PDO::FETCH_ASSOC);
			$paire = 0;
			while($ligne= $rese->fetch()){
				$num = $ligne["numsecu"];
				$nome = $ligne["nome"];
				$prenome = $ligne["prenome"];
				
  			$paire += 1;
  			if($paire%2 == 0){
  				echo("<div class='droite'>");
					echo("<input type='checkbox' id='$num' name='$num' value='o'>");
					echo("<label for='$num'>$nome $prenome</label>");
					echo("</div>");
  				echo("<br/><br/>");
  			}else{
  				echo("<div class='gauche'>");
					echo("<input type='checkbox' id='$num' name='$num' value='o'>");
  				echo("<label for='$num'>$nome $prenome</label>");
  				echo("</div>");
  			}
			}
			echo("</div>\n");
			
			echo("<div id='valid'>\n");
			echo("<input type='reset' name='reset' value='Effacer' />\n");
			echo("<input type='submit' name='mainte' value='Ajouter' />\n");
			echo("</div>\n");
			echo("</form>\n");
		}
		
		/*\ [] {}*/

		echo("<form action='gestion_interve.php' method='post' id='form'>\n");
		echo("<h3>Installation:</h3>\n");
		
		echo("<div class='texte'>\n");
		echo("<p>choisir la facture qui est a l'origine de l'installation:</p>\n");
		
		echo("<select name='client'>");
		$requetclideux = "SELECT acheter.numfacture, client.idclient, nomc, prenomc FROM client, acheter where client.idclient = acheter.idclient and acheter.codeinstall = -1;";
		$rese = $pro->query($requetclideux);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $rese->fetch()){
			$num = $ligne["idclient"];
			$nomc = $ligne["nomc"];
			$prenomc = $ligne["prenomc"];
			$install = $ligne["numfacture"];
			echo("<option value='$install'> $install $nomc $prenomc </option>\n");
		}
		echo("</select><br/><br/>");
		
		echo("<p> Date prévue pour l'instalation:</p>\n");
		echo("<select name='jour'>\n");
		for($i=1; $i < 32; $i++){
			echo("<option value='$i'> $i </option>\n");
		}
		echo("</select>\n");
		echo("<select name='mois'>\n");
		for($i=1; $i < 13; $i++){
			echo("<option value='$i'> $i </option>\n");
		}
		echo("</select>\n");
		$det = date('Y');
		echo("<select name='annee'>\n");
		for($i=0; $i < 3; $i++){
			$ann = $det + $i;
			echo("<option value='$ann'> $ann </option>\n");
		}
		echo("</select>\n");
		
		echo("<p> Responsable:</p>\n");
		echo("<select name='respon'>");
		$requetemploy = "SELECT numsecu, nome, prenome FROM employes WHERE role = 'responsable technique';";
		$rese = $pro->query($requetemploy);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $rese->fetch()){
			$num = $ligne["numsecu"];
			$nome = $ligne["nome"];
			$prenome = $ligne["prenome"];
			echo("<option value='$num'> $nome $prenome </option>\n");
		}
		echo("</select><br/><br/>");
		echo("</div>\n");
		
		echo("<div class='texte'>\n");
		echo("<p> Employé pour l'intervention:</p>\n");
		$requetemploy = "SELECT numsecu, nome, prenome FROM employes WHERE role = 'employe';";
		$rese = $pro->query($requetemploy);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		$paire = 0;
		while($ligne= $rese->fetch()){
			$num = $ligne["numsecu"];
			$nome = $ligne["nome"];
			$prenome = $ligne["prenome"];
			$paire += 1;
			if($paire % 2 == 0){
				echo("<div class='droite'>");
				echo("<input type='checkbox' id='$num' name='$num' value='o'>");
				echo("<label for='$num'>$nome $prenome</label>");
				echo("</div>");
				echo("<br/><br/>");
			}else{
				echo("<div class='gauche'>");
				echo("<input type='checkbox' id='$num' name='$num' value='o'>");
				echo("<label for='$num'>$nome $prenome</label>");
				echo("</div>");
			}
		}
		echo("</div>\n");
		
		echo("<div id='valid'>");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='install' value='Ajouter' />\n");
		echo("</div>");
		
		echo("</form>\n");

		echo("</section>");
	}
	
	
?>

<?php
  include("footer.html");
?>
</body>
</html>
