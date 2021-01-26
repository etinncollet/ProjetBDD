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
		padding: 20px;
		margin: 20px;
		border: 1px solid black;
		vertical-align: top;
		width: 90%;
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
		$id = $_POST['idc'];
		$requa = "select adressec, telc from client where idclient = $id;";
		$res = $pro->query($requa);
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$adre = $res->fetch();
		$te = $adre['telc'];
		list($pa, $rue, $c) = explode ( '_' , $adre['adressec']);
		if(isset($_POST['adres']) && $_POST['adres'] != ""){
			echo(" 1 ");
			$rue = $_POST['adres'];
		}
		if(isset($_POST['cod']) && $_POST['cod'] != ""){
			echo(" 2 ");
			$c = $_POST['cod'];
		}
		if(isset($_POST['pays']) && $_POST['pays'] != ""){
			echo(" 3 ");
			$pa = $_POST['pays'];
		}
		if(isset($_POST['telephone']) && $_POST['telephone'] != ""){
			echo(" 5 ");
			$te = $_POST['telephone'];
		}
		
		$lst = array($pa, $rue, $c);
		$nouv_a = implode ( "_" , $lst); 
		$no = "$nouv_a";
		$modif = "UPDATE client SET telc = '$te' WHERE idclient = $id;";
		$res = $pro->exec($modif);
		$modif = "UPDATE client SET adressec = '$no' WHERE idclient = $id;";
		$res = $pro->exec($modif);
		echo("<form action='client_general.php' method='get' id='form'>");
		echo("<h3>Les modification ont bien ete faite</h3>");
		echo("<input type='submit' name='retour' value='Retour'/>");
		echo("</form>");
		echo("</section>");
	}
?>

<?php
  include("footer.html");
?>
</body>
</html>
