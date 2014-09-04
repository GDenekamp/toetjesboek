<?php
/*
* Naam:            Gerben Denekamp
* Versie:          2
* Scriptnaam:      functions.php
* 
* Gemaakt door:    Gerben Denekamp
* Hulp van:        Internet
* 
* Doel van script: functions bieden veiligheid bij input in dit geval
* 
*/
include_once'classes/DB.php';

function safe_text($tekst)
{
	$tekst = trim($tekst);
	htmlentities($tekst);
	
	return $tekst;
}

function is_num($tekst)
{
	if(!empty($tekst))
	{
		//Checks if $tekst is an integer
		if(!preg_match("/^-?[1-9][0-9]*$/D", $tekst))
		{
			echo "geen getal ingevoerd!";
			$tekst = 1;
		}
		return $tekst;
	}
	else{
		$tekst = 1;
		return $tekst;
	}
}

?>