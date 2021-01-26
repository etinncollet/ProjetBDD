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
  <title>projet_footer</title>
</head>
<style>
	section {
		margin:0px 200px 0px 200px;
		padding: 10px;
		padding-bottom: 296px;
		background-color: white;
	}
	#acc {
		text-align: center;
	}
</style>
<body>
<?php
/*\ [] {}*/
  include("header.php");
?>
	<section>
  <h1 id="acc">Site entreprise</h1>
  <p>
  Ceci est un site pour l'entreprise "SECURIT". <br/> 
Il est excusivement réservé aux responsables et employés de l'entreprise. <br/> 
- Si vous ne faites pas partie de cela, votre séjour sur ce site sera limité.<br/>
- Si en revanche vous faites partie des deux catégories évoquées précédemment, veuillez-vous identifier pour pouvoir continuer et accéder aux données. <br/><br/>
Les onglets ci-dessus sont des catégories et comportent plusieurs options visibles uniquement en cliquant dessus.<br/>
  </p>
	</section>
<?php
  include("footer.html");
?>
</body>
</html>
