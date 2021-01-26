<?php 
session_start(); 
$deco = !empty($_POST['sub']) ? $_POST['sub'] : NULL;
if($deco == "Valider"){
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
	h1 {
		padding: 0px 40px 0px 40px;
	}
	.identif {
		margin:0px 200px 0px 200px;
		padding: 10px;
		padding-bottom:75px;
		padding-top: 250px;
		background-color: white;
		text-align: center;
	}
	#err {
		display: inline-block;
		padding: 0px;
		color: black;
	}
	#form {
		background-color:#F1B164;
		display: inline-block;
		padding: 50px;
		border: 1px solid black;
	}
	#deco {
		margin: 50px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	#deconex{
		padding-bottom:129px;
		padding-top: 268px;
	}
	#accuei {
		background-color: #DCDCDC;
		border: 1px solid black;
	}
</style>
<?php
/*\ [] {}*/

require("connexion.inc.php");
$ident = !empty($_POST['idt']) ? $_POST['idt'] : NULL;
$modpas = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;
$co = !empty($_POST['submit']) ? $_POST['submit'] : NULL;


if($_SESSION["nom"] == ""){
	if(isset($ident) == 1 && isset($modpas) == 1){
		$requet_idt = "SELECT motdepasse FROM employes WHERE identifiant = '$ident';";
		$res_mdp = $pro->query($requet_idt);
		$res_mdp->setFetchMode(PDO::FETCH_ASSOC);
		$ligne = $res_mdp->fetch();
		$mdp_enr = $ligne["motdepasse"];
		if(isset($mdp_enr) == 1){
			if($modpas == $mdp_enr){
				$req_inf = "SELECT numsecu, nome||' '||prenome AS nomcomp, role FROM employes WHERE identifiant = '$ident';";
				$res_inf = $pro->query($req_inf);
				$res_inf->setFetchMode(PDO::FETCH_ASSOC);
				$ligne_i = $res_inf->fetch();
				$nomc = $ligne_i["nomcomp"];
				$num = $ligne_i["numsecu"];
				$role = $ligne_i["role"];
				$_SESSION["nom"] = "$nomc";
				$_SESSION["num"] = "$num";
				$_SESSION["role"] = "$role";
				
				header("refresh: 0");
			}else{
				$erreur = "Il y a un probleme avec <br/>l'identifiant ou le mot de passe.";
			}
		}else{
			$erreur = "Il y a un probleme avec <br/>l'identifiant.";
		}
	}
	include("header.php");
	echo("<body>");
	echo("<section class='identif'>");
	echo("<div id='form'>");
	echo("<h1>Identifiez vous :</h1>");
	echo("<form action='formu_ident.php' method='post'>");
	echo("<p> Identifiant</p>");
	echo("<input type='text' name='idt' size=20  />");
	echo("<p> Mot de passe</p>");
	echo("<input type='password' name='mdp' size='20'/><br/><br/>");
	echo("<input type='reset' name='reset' value='Effacer' />"); 
	echo("<input type='submit' name='submit' value='Valider' />");
			if(isset($erreur)){
				echo("<br/><br/><p id='err'>$erreur</p>");
			}
	echo("</form>");
	echo("</div>");
	echo("</section>");
}else{
	include("header.php");
	echo("<section id='deconex' class='identif'>");
	echo("<div id='form'>");
	echo("<h1>Deconnexion:</h1>");
	echo("<p>Êtes-vous sûr de vouloir vous déconnecter ?</p>");
	echo("<form action='formu_ident.php' method='post'>");
	echo("<input id='deco' type='submit' name='sub' value='Valider' />");
	echo("</form>");
	echo("<a href='corp.php' class='button' id='accuei'>Retourner à l'accueil</a>");
	echo("</div>");
	echo("</section>");
}

?>
<?php
include("footer.html");
?>
</body>
</html>
