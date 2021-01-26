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
		padding-bottom: 109px;
		padding-top: 40px;
		background-color: white;
		text-align: center;
	}
	#leg1 {
		line-height: 1.5em;
	}
	#legi {
		background-color:#F1B164;
		padding: 20px;
		border: 1px solid black;
	}
</style>
<body>
<?php
/*\ [] {}*/
  include("header.php");
?>
	<section>
  <h1 id="legi">Site entreprise</h1>
  <br/>
  <p id="leg1">
	Ce site web est celui de l’entreprise « SecuriT » et appartient à Collet Etienne et Bendiaf Noam.<br/>Vous pouvez respectivement les contacter par email à ecollet@etud.u-pem.fr et nbendiaf@etud.u-pem.fr <br/>ou par téléphone au 0695352918 et 0656386274.<br/>

	</p>
	<br/>
	<p id="leg1">
	Le numéro d’inscription de SecuriT au RCS est le RCS PARIS B 571568493 00021.<br/>
	L'adresse du siege scocial est: 7 rue du paradis, 94 500 Coeuilly.<br/><br/>
	Ce site utilise des cookies.
	<br/>
	Pour toutes réclamations ou plaintes, vous pouvez aussi contacter la CNIL.
  </p>
	</section>
<?php
  include("footer.html");
?>
</body>
</html>
