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
	.replir{
		display: inline-block;
		background-color: #F1B164;
		padding: 20px;
		margin:-3px;
		border: 1px solid black;
		height: 300px;
		vertical-align: top;
	}
	#info{
		display: block;
		background-color: #DCDCDC;
		padding: 20px;
		border: 1px solid black;
		margin: 10px;
	}
	#info{
		display: block;
		margin: 10px;
	}
	#affiche{
		display: inline-block;
		vertical-align: top;
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
	}
	#form2 {
		background-color:#F1B164;
		display: inline-block;
		padding: 20px;
		margin: 10px;
		border: 1px solid black;
		vertical-align: top;
		width: 332px;
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
		echo("<div id='affiche'>");
		echo("<h1>Gestion des employés de l'entreprise:</h1>\n");
		echo("<form action='gestion_employe.php' method='post' id='form'>\n");
		echo("<h3>Ajouter un employé:</h3>\n");
		
		echo("<section class='replir'>\n");
		
		echo("<p> Nom:</p>\n");
		echo("<input type='text' name='nom' size='20' /> <br/><br/>\n");
		
		echo("<p> Prenom:</p>\n");
		echo("<input type='text' name='prenom' size='20' /> <br/><br/>\n");
		
		echo("<p> Numéro de Securité Sociale:</p>\n");
		echo("<input type='text' name='numsec' size='16' /> <br/><br/>\n");
		
		echo("</section>\n");
		echo("<section class='replir'>\n");
		
		echo("<p> Rôle:</p>\n");
		echo("<select name='role'>");
		echo("<option value='employe'> employe </option>\n");
		echo("<option value='responsable technique'> responsable technique </option>\n");
		echo("<option value='administratif'> administratif </option>\n");
		echo("</select><br/><br/>");
		
		
		echo("<p> Identifiant(facultatif):</p>\n");
		echo("<input type='text' name='identif' size='20' /> <br/><br/>\n");
		
		echo("<p> Mot de passe(facultatif):</p>\n");
		echo("<input type='text' name='mdp' size='15' /> <br/><br/>\n");
		
		echo("</section>\n");
		
		echo("<div id='valid'>");
		echo("<input type='reset' name='reset' value='Effacer' />\n");
		echo("<input type='submit' name='ajou' value='Ajouter' />\n");
		echo("</div>");
		echo("</form>\n");
		
		if(isset($_POST['supre'])){
			$num = $_POST['employe'];
			$requetsupre = "DELETE FROM employes WHERE numsecu = '$num';";
			$rese = $pro->exec($requetsupre);
			echo("<div id='info'>");
			echo("La suppression a bien été faite.<br/><br/>");
			echo("<form action='gestion_employe.php' method='POST'>");
			echo("<input type='submit' name='val' value='ok' />");
			echo("</form>");
			echo("</div>");
		}elseif(isset($_POST['ajou'])){
			if(isset($_POST['numsec']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['role'])){
				$nums = $_POST['numsec'];
				$no = $_POST['nom'];
				$preno = $_POST['prenom'];
				$role = $_POST['role'];
				if(isset($_POST['identif']) && isset($_POST['mdp'])){
					$ident = $_POST['identif'];
					$motdp = $_POST['mdp'];
					$requetajou = "INSERT INTO employes VALUES( '$nums', '$no', '$preno', '$role', '$ident', '$motdp');";
				}else{
					$requetajou = "INSERT INTO employes VALUES( '$nums', '$no', '$preno', '$role');";
				}
				
				$rese = $pro->exec($requetajou);
				echo("<div id='info'>");
				echo("L'ajout de cette employé a bien été fait<br/><br/>");
				echo("<form action='gestion_employe.php' method='POST'>");
				echo("<input type='submit' name='val' value='ok' />");
				echo("</form>");
				echo("</div>");
			}else{
				echo("<div id='info'>");
				echo("L'ajout de cette employé a échoué.<br/>Vous avez oublié des informations.<br/>");
				echo("<form action='gestion_employe.php' method='POST'>");
				echo("<input type='submit' name='val' value='ok' />");
				echo("</form>");
				echo("</div>");
			}
		}elseif(isset($_POST['mdp_mod']) && isset($_POST['identif']) && isset($_POST['mdp']) && isset($_POST['employe'])){
			$ident = $_POST['identif'];
			$motdp = $_POST['mdp'];
			$num = $_POST['employe'];
			$reqmodif1 = "UPDATE employes SET identifiant = '$ident' WHERE numsecu = '$num';";
			$rese = $pro->exec($reqmodif1);
			$reqmodif2 = "UPDATE employes SET motdepasse = '$motdp' WHERE numsecu = '$num';";
			$rese = $pro->exec($reqmodif2);
			echo("<div id='info'>");
			echo("La modification des information de connexion ont reussi<br/>");
			echo("<form action='gestion_employe.php' method='POST'>");
			echo("<input type='submit' name='val' value='ok' />");
			echo("</form>");
			echo("</div>");
		}
		echo("</div>");
		
		echo("<div id='affiche'>");
		echo("<form action='gestion_employe.php' method='POST' id='form'>");
		echo("<h3 id='deux' >Supprimer un employé:</h3>");
		echo("<p> Employer:</p>");
		echo("<select name='employe'> ");
		$requetemplo = "SELECT numsecu, nome, prenome FROM employes WHERE role != 'PDG';";
		$rese = $pro->query($requetemplo);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $rese->fetch()){
			$nume = $ligne["numsecu"];
			$nome = $ligne["nome"];
			$prenome = $ligne["prenome"];
			echo("<option value='$nume'> $nome $prenome </option>\n");
		}
		echo("</select> ");

		echo("<input type='submit' name='supre' value='supprimer' />");

		echo("</form>");

		echo("<div id='info2'>");
		echo("<form action='gestion_employe.php' method='POST' id='form2'>");
		echo("<h3 id='deux' >modifier les <br/>information de connexion:</h3>");
		echo("<p> Employer:</p>");
		echo("<select name='employe'> ");
		$requetemplo = "SELECT numsecu, nome, prenome FROM employes WHERE role != 'PDG';";
		$rese = $pro->query($requetemplo);
		$rese->setFetchMode(PDO::FETCH_ASSOC);
		while($ligne= $rese->fetch()){
			$nume = $ligne["numsecu"];
			$nome = $ligne["nome"];
			$prenome = $ligne["prenome"];
			echo("<option value='$nume'> $nome $prenome </option>\n");
		}
		echo("</select> ");
		
		echo("<p> Identifiant:</p>\n");
		echo("<input type='text' name='identif' size='20' /> <br/><br/>\n");
		
		echo("<p> Mot de passe:</p>\n");
		echo("<input type='text' name='mdp' size='15' /> <br/><br/>\n");
		
		echo("<input type='submit' name='mdp_mod' value='modifier' />");

		echo("</form>");
		echo("</div>");
		/*\ [] {}*/
		echo("</div>");
		echo("</section>");
	}
	
	
?>

<?php
  include("footer.html");
?>
</body>
</html>
