<?php
/*
* Naam:            Gerben Denekamp
* Versie:          1
* Scriptnaam:      logout.php
* 
* Gemaakt door:    Gerben Denekamp
* Hulp van:        Internet
* 
* Doel van script: gebruiker uitloggen en sessie beeindigen
* 
*/
//beindigd sessie van de gebruiker en redirect de gebruiker naar index.php
session_start();
session_destroy();
header('Location: ../index.php?status=3');
exit;
?>