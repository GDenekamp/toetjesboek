<?php
/*
* Naam:            Gerben Denekamp
* Versie:          3
* Scriptnaam:      home.php
* 
* Gemaakt door:    Gerben Denekamp
* Hulp van:        Internet, php lessen
* 
* Doel van script: Mogelijkheid geven om gebruiker gerechten te selecteren en aantal personen in te voeren
* 
*/
error_reporting(0);
session_start();
require_once'classes/DB.php';
require_once'functions/functions.php';

/****************************************************************
* Als de sessie is verlopen dan krijg je de foutmelding        *
* " Je bent niet ingelogd " Dit is weer een stukje veiligheid. *
***************************************************************/

if(!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] != true)
{
	die("Je bent niet ingelogd!<br />" . "<a href=\"login.php\">Klik hier om in te loggen</a>");
}

//POSTs from home page forms
$gerechtnaam = $_POST['gerechtnaam'];
if(empty($_POST['gerechtnaam']))
{
	$gerechtnaam = "Coupe Kiwano";
}

//Sets $aantal_personen default to 1
if(empty($_POST['aantal_personen']))
{
	$aantal_personen = 1;
}
//aantal personen wordt getest of het een getal is of niet
$aantal_personen = is_num($_POST['aantal_personen']);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
		<title>Toetjesboek</title>
	
		<link rel="stylesheet" type="text/css" href="../view/CSS/style.css">
	
		<meta name="description" content="">
		<meta name="author" content="maurice">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>

	<body>
		<h1>Het toetjesboek</h1>
		<div class="content">
			<header class="gerechtnaam">
				<h2><?php echo $gerechtnaam ?></h2>
			</header>

			<div>
				<p class="tijdEnEnergie homeDivs">
					<?php //selecteer bereidingstijd en EnergiePP op basis van gerechtnaam?>
					<strong>Bereidingstijd: </strong><?php $db->selectBereidingstijd($gerechtnaam);?><br />
					<strong>EnergiePP: </strong><?php $db->selectEnergiePP($gerechtnaam);?>
				</p>
			</div>

			<p style="clear: both"></p>
			
			<div class="homeDivs">
				<?php //selecteer bereidingswijze op basis van gerechtnaam?>
				<strong>Bereidingswijze: </strong><br />
				<p>
					<?php $db->selectBereidingswijze($gerechtnaam);?>
				</p>
			</div>

			<p style="clear: both"> </p>

			<div class="homeDivs">
				<?php //selecteer ingredienten op basis van gerechtnaam en het aantal personen ?>
				<strong>Ingredienten voor: </strong><?php if($aantal_personen == 1){echo $aantal_personen . " persoon";}else{echo $aantal_personen . " personen";}?>
				<p><?php $db->selectIngredient($gerechtnaam, $aantal_personen);?></p>
			</div>
			
			<div class="homeDivs">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>Gerechtnaam: </label>
					<select name="gerechtnaam">
						<?php 
						//Roep de classe aan om gerechtopties in het selectieveld te zetten
							$db->selectOptionsGerecht();
						?>
					</select>
					<label>Aantalpersonen: </label><input type="text" name="aantal_personen" size="4" />
					<input type="submit" value="zoeken"/>
				</form>
			</div>
			<div class="linkDiv">
				<p><a href="zoek.php">Zoek opties</a></p>
				<p><a href="logout.php">Logout</a></p>
			</div>
		</div>

		<p style="clear: both"></p>

		<footer>
			&copy; 2014 Copyright by Gerben, Wilco en Maurice
		</footer>

	</body>
</html>
