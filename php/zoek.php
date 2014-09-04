<?php
/*
* Naam:            Gerben Denekamp
* Versie:          3
* Scriptnaam:      zoek.php
* 
* Gemaakt door:    Gerben Denekamp
* Hulp van:        Internet
* 
* Doel van script: gebruiker de mogelijkheid bieden om gerechten, ingredienten en bereidingstijden te zoeken
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
//haal posts uit de zoekvelden op
$zoek_gerecht = safe_text($_POST['zoek_gerecht']);
$zoek_ingredient = safe_text($_POST['zoek_ingredient']);
$zoek_bereidingstijd = is_num($_POST['zoek_bereidingstijd']);

?>
<html>
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
			<header>
				<h2>Zoekfunctie</h2>
			</header>
			<div class="homeDivs">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td><label><strong>Zoeken:</strong></label></td>
						</tr>
						<tr>
							<td><label>Gerechtnaam: </label></td>
							<td><input type="text" name="zoek_gerecht"></td>
						</tr>
						<tr>
							<td><label>Ingredient: </label></td>
							<td><input type="text" name="zoek_ingredient"></td>
						</tr>
						<tr>
							<td><label>Bereidingstijd < : </label></td>
							<td><input type="text" name="zoek_bereidingstijd"></td>
						</tr>
						<tr>
							<td><input type="submit" value="zoek" /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="homeDivs">
				<?php //Roep de classe en de functies aan op basis van de variablele om resultaten op het scherm te tonen?>
				<?php $db->zoekGerecht($zoek_gerecht)?>
				<?php $db->zoekIngredient($zoek_ingredient); ?>
				<?php $db->zoekBereidingstijd($zoek_bereidingstijd); ?>
			</div>
			<div class="linkDiv">
				<p><a href="home.php">Terug naar Home</a></p>
				<p><a href="logout.php">Logout</a></p>
			</div>
		</div>
		<div style="clear: both"></div>
		<footer>
			&copy; 2014 Copyright by Gerben, Wilco en Maurice
		</footer>
	</body>
</html>