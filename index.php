<?php
/*
* Naam:            Gerben Denekamp
* Versie:          2
* Scriptnaam:      DB.php
* 
* Gemaakt door:    Wilco Logger, Gerben Denekamp
* Hulp van:        Internet, Lessen
* 
* Doel van script: eerste scherm waar gebruiker aankomt en zich aan meld.
* 
*/
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
		<title>Toetjesboek</title>
	
		<link rel="stylesheet" type="text/css" href="view/CSS/style.css">
	
		<meta name="description" content="">
		<meta name="author" content="maurice">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
   <body>
   	<div class="content-index">
   		<div class="form">
           <h1>Toetjesboek</h1>
           <form id='login' action="php/login.php" method="post">
               <table>
                   <tr>
                       <td>Naam:</td>
                       <td><input type="text" name="gebruikersnaam" size="20px" placeholder=" Gebruikersnaam "/></td>
                   </tr>
                   <tr>
                       <td>Wachtwoord:</td>
                       <td><input type="password" name="wachtwoord" size="20px" placeholder=" Wachtwoord "/></td>
                   </tr>
                   <tr>
                       <td></td>
                       <td><input type="submit" name="submit" value="Inloggen" /></td>
                   </tr>
                   <tr>
                       <td></td>
                       <td>
                       <?php
                           $status_array[1] = "U heeft niets ingevoerd";
                           $status_array[2] = "Gebruikersnaam of Wachtwoord komen niet overeen";
						   $status_array[3] = "U bent uitgelogd";
                           
                           echo $status_array[$_GET[status]];
                           
                           if ($_GET[status]) {
                               session_destroy();
                           }
                       ?>
                       </td>
                   </tr>
               </table>
           </form>
       </div>
     </div>
     <footer>
			&copy; 2014 Copyright by Gerben, Wilco en Maurice
		</footer>
   </body>
</html>