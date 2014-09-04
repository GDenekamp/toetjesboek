<?php
/*
* Naam:            Wilco Logger
* Versie:          5
* Scriptnaam:      login.php
* 
* Gemaakt door:    Wilco Logger
* Hulp van:        Internet, php lessen en Rik Brugman
* 
* Doel van script: Controlleren of de gebruiker bestaan en kan inloggen.
* 
*/

session_start();
// De connectie naar de database maken
require_once'classes/DB.php';

// De opgevraagd gebruikersnaam en wachtwoord
$gebruikersnaam = safe_text($_POST['gebruikersnaam']);
$wachtwoord     = safe_text($_POST['wachtwoord']);

// controleer of de query wel overeen komt
if (!empty($gebruikersnaam) && !empty($wachtwoord)) {
   
   $query = $db->query("SELECT id FROM gebruikers WHERE gebruikersnaam = '" .$gebruikersnaam. "' AND wachtwoord = '". md5($wachtwoord). "'");
   
   // Als id geen 0 is dan bestaad de gebruiker en mag je naar de volgende pagina
   // Is het wel een o ga dan door naar else
   if(mysqli_num_rows($query) > 0) {
       
       $_SESSION['user_logged_in'] = true;
       header("Location: home.php");
       
   } else {
       
       // Dit is een stukje veiligheid. we willen niet dat andere weten wat er fout ging.
       header('Location: ../index.php?status=2'); // Gebruikersnaam of wachtwoord komen niet overeen!
   }
   
} else {
   
   // Als er niks is ingevult dan krijg je de status 1
   header('Location: ../index.php?status=1'); // Je hebt niets ingevoerd
   exit();
   
}
?>