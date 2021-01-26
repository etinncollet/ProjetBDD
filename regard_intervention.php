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
		padding-bottom: 200px;
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
	#com {
		background-color: #DCDCDC;
		border: 1px solid black;
		display: block;
		padding: 20px;
		text-align: center;
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
  	border: 1px solid black;
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
	.param{
		display: inline-block;
		background-color:#F1B164;
		padding: 8px;
		margin-top: 179px;
		border: 1px solid black;
		position: fixed;
		width:100%;
	}
	.select{
		display: inline-block;
		padding-right: 60px;
		padding-left: 20px;
	}
	.envoie{
		display: inline-block;
		padding-right: 50px;
		float: right;
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
	if(isset($_GET['enci']) && ( $_GET['periode'] != 'all' || $_GET['clicli'] != 'all' || $_GET['employer'] != 'all')){
		if($_GET['periode'] == '1s'){
			$date = date('Y-m-j', strtotime('-7 day'));
		}elseif($_GET['periode'] == '1m'){
			$date = date('Y-m-j', strtotime('-31 day'));
		}elseif($_GET['periode'] == '6m'){
			$date = date('Y-m-j', strtotime('-184 day'));
		}elseif($_GET['periode'] == '1a'){
			$date = date('Y-m-j', strtotime('-365 day'));
		}
		if($_GET['periode'] != 'all'){
			if($_GET['clicli'] != 'all'){
				$cli = $_GET['clicli'];
				if($_GET['employer'] != 'all'){
					$emp = $_GET['employer'];
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											
											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and employes.numsecu = '$emp' 
											and client.idclient = $cli
											and intervention.dateinter > '$date';";
					$reqinst = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 												from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and employes.numsecu = '$emp' 
											and client.idclient = $cli
											and installation.dateinstall > '$date';";
				}else{
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and client.idclient = $cli
											and intervention.dateinter > '$date';";
					$reqinst = "select distinct codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where client.idclient = $cli
											and installation.dateinstall > '$date';";
				}
			}else{
				if($_GET['employer'] != 'all'){
					$emp = $_GET['employer'];
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and employes.numsecu = '$emp' 
											and intervention.dateinter > '$date';";
					$reqinst = "select distinct codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where employes.numsecu = '$emp' 
											and installation.dateinstall > '$date';";
				}else{
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and intervention.dateinter > '$date';";
					$reqinst = "select distinct codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where installation.dateinstall > '$date';";
				}
			}
		}
		if($_GET['periode'] == 'all'){
			if($_GET['clicli'] != 'all'){
			$cli = $_GET['clicli'];
				if($_GET['employer'] != 'all'){
					$emp = $_GET['employer'];
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and employes.numsecu = '$emp' 
											and client.idclient = $cli;";
					$reqinst = "select codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where employes.numsecu = '$emp' 
											and client.idclient = $cli;";
				}else{
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and client.idclient = $cli;";
					$reqinst = "select distinct codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where client.idclient = $cli;";
				}
			}else{
				if($_GET['employer'] != 'all'){
					$emp = $_GET['employer'];
					$reqmaint = "select distinct intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter 											from employes, faire, intervention, contrat, client 
											where employes.numsecu = faire.numsecu 
											and faire.codeinter = intervention.codeinter 
											and intervention.numcontrat = contrat.numcontrat 
											and contrat.idclient = client.idclient 
											and employes.numsecu = '$emp';";
					$reqinst = "select distinct codeinstall, dateinstall, client.nomc, client.prenomc 
											from employes natural join installation natural join acheter natural join client 
											where employes.numsecu = '$emp';";
				}
			}
		}	
	}else{
		$reqmaint = "select intervention.dateappel, intervention.dateinter, client.nomc, client.prenomc, intervention.codeinter from intervention natural join contrat natural join client;";
		$reqinst = "select codeinstall, dateinstall, client.nomc, client.prenomc from installation natural join acheter natural join client;";
	}
	$reqcli = "select idclient, nomc, prenomc from client;";
	$reqempl = "select numsecu, nome, prenome from employes;";
	echo("<form action='regard_intervention.php' method='get'>\n");
	echo("<div class='param'>\n");
	echo("<div class='select'>\n");
	echo("periode : ");
	echo("<select name='periode'>");
	echo("<option value='all'> tous </option>\n");
	echo("<option value='1s'> 1 semaine </option>\n");
	echo("<option value='1m'> 1 mois </option>\n");
	echo("<option value='6m'> 6 mois </option>\n");
	echo("<option value='1a'> 1 an </option>\n");
	echo("</select>");
	echo("</div>");
	echo("<div class='select'>");
	echo("employer : ");
	echo("<select name='employer'>");
	$rese = $pro->query($reqempl);
	$rese->setFetchMode(PDO::FETCH_ASSOC);
	echo("<option value='all'> tous </option>\n");
	while($ligne= $rese->fetch()){
		$nume = $ligne['numsecu'];
		$nome = $ligne['nome'];
		$prenome = $ligne['prenome'];
		echo("<option value='$nume'> $nome $prenome </option>\n");
	}
	echo("</select>");
	echo("</div>");
	echo("<div class='select'>");
	echo("client : ");
	echo("<select name='clicli'>");
	$resc = $pro->query($reqcli);
	$resc->setFetchMode(PDO::FETCH_ASSOC);
	echo("<option value='all'> tous </option>\n");
	while($ligne= $resc->fetch()){
		$numc = $ligne['idclient'];
		$nomc = $ligne['nomc'];
		$prenomc = $ligne['prenomc'];
		echo("<option value='$numc'> $nomc $prenomc </option>\n");
	}
	echo("</select>\n");
	echo("</div>\n");
	echo("<div class='envoie'>");
	echo("<input type='submit' name='enci' value='appliquer' />\n");
	echo("</div>\n");
	echo("</div>\n");
	echo("</form>\n");
	
	
	echo("<section>\n");
	echo("<h1 id='tete'>liste des intervention:</h1>\n");
	echo("<table>\n");
	echo("<thead>\n");
	echo("<tr><th>type</th><th>Numero</th><th>Client</th><th>date appel</th><th>date intervention</th></tr>\n");
	echo("</thead>\n");
	echo("<tbody>\n");
	$resm = $pro->query($reqmaint);
	echo($reqmaint);
	$resm->setFetchMode(PDO::FETCH_ASSOC);
	while($ligne= $resm->fetch()){
		$inter = $ligne['codeinter'];
		$appel = $ligne['dateappel'];
		$date = $ligne['dateinter'];
		$nome = $ligne['nomc'];
		$prenome = $ligne['prenomc'];
			echo("<tr><td>maintenance</td><td>$inter</td><td>$nome $prenome</td><td>$appel</td><td>$date</td></tr>");
	}
	$resm = $pro->query($reqinst);
	/*echo($resm);*/
	$resm->setFetchMode(PDO::FETCH_ASSOC);
	while($ligne= $resm->fetch()){
		$inter = $ligne['codeinstall'];
		/*$appel = $ligne['dateappel'];*/
		$date = $ligne['dateinstall'];
		$nome = $ligne['nomc'];
		$prenome = $ligne['prenomc'];
			echo("<tr><td>instalation</td><td>$inter</td><td>$nome $prenome</td><td></td><td>$date</td></tr>");
	}
	echo("</tbody>");
	echo("</table>");

	echo("</section>");
}
include("footer.html");
?>
</body>
</html>
