<?php
/*
* Naam:            Gerben Denekamp
* Versie:          5
* Scriptnaam:      DB.php
* 
* Gemaakt door:    Gerben Denekamp
* Hulp van:        Internet, Rik Brugman
* 
* Doel van script: Class maken die de verbinding met de database maakt en alle query's afhandeld die de gebruiker opvraagd
* 
*/
include 'config/Config.php';
require_once'functions/functions.php';

class Database {
   
   	private $link;
   	private $host, $username, $password, $database;
   	private $gerechtnaam;
	private $aantal_personen;
   
   public function __construct($host, $username, $password, $database) {
       $this->host        = $host;
       $this->username    = $username;
       $this->password    = $password;
       $this->database    = $database;
       
       $this->link = mysqli_connect($this->host, $this->username, $this->password)
       OR die("There was a problem connecting to the database.");
       
       mysqli_select_db($this->link, $this->database)
           OR die("There was a problem selecting the database.");
           return true;
   }
   
   public function query($query) {
       
       $result = mysqli_query($this->link, $query);
       if (!$result) die('Invalid query: ' . mysqli_error($this->link));
       return $result;
   }

	###################################################################################################
	###																								###
	###								Start query's ophalen											###
	###																								###
	###################################################################################################
   // functie met de query om bereidingswijze op te halen en de te echoen op het scherm op basis van $gerechtnaam
   public function selectBereidingswijze($gerechtnaam)
	{
		$select_bereidingswijze = mysqli_query($this->link,"SELECT bereidingswijze FROM Gerecht WHERE gerechtnaam = '$gerechtnaam'");
		while($row=mysqli_fetch_array($select_bereidingswijze))
		{
			echo $row['bereidingswijze'] . "<br />";
		}
	}
	// functie met de query om Ingredienten op te halen en de te echoen op het scherm * het aantal personen op basis van $gerechtnaam en $aantal_personen
	public function selectIngredient($gerechtnaam,$aantal_personen)
	{
		$select_ingredient= mysqli_query($this->link,"SELECT Ingredient.*, Product.eenheidnaam FROM Ingredient LEFT JOIN Product ON Ingredient.productnaam = Product.productnaam WHERE gerechtnaam = '$gerechtnaam'");
		while($row=mysqli_fetch_array($select_ingredient))
		{
			echo $row['hoeveelheidPP'] * $aantal_personen . " " .$row['eenheidnaam'] . " " .$row['productnaam'] . "<br />";
		}
	}
	// functie met de query om EnergiePP op te halen en de te echoen op het scherm op basis van $gerechtnaam
	public function selectEnergiePP($gerechtnaam)
	{
		$select_energie = mysqli_query($this->link,"SELECT energiePP FROM Gerecht WHERE gerechtnaam = '$gerechtnaam'");
		while($row=mysqli_fetch_array($select_energie))
		{
			echo $row['energiePP'] . "<br />";
		}
	}
	// functie met de query om bereidingstijd op te halen en de te echoen op het scherm op basis van $gerechtnaam
	public function selectbereidingstijd($gerechtnaam)
	{
		$select_bereidingstijd = mysqli_query($this->link,"SELECT bereidingstijd FROM Gerecht WHERE gerechtnaam = '$gerechtnaam'");
		while($row=mysqli_fetch_array($select_bereidingstijd))
		{
			echo $row['bereidingstijd'] . " Min<br />";
		}
	}
	//functie met de query om de opties van het selectieveld op te halen en de te echoen op het scherm op basis van $gerechtnaam
	public function selectOptionsGerecht($gerechtnaam)
	{
		$gerechten = mysqli_query($this->link,"SELECT gerechtnaam FROM Gerecht");
		while($row=mysqli_fetch_array($gerechten))
		{
			echo "<option>" . $row['gerechtnaam'] . "</option>";
		}
	}
	// functie met de query om zoekresultaten uit de database te halen en te echoen
	public function zoekGerecht($zoek_gerecht)
	{
		if(!empty($_POST['zoek_gerecht']))
		{
			//Query zoeken op gerechtnaam
			$gevonden_gerecht = mysqli_query($this->link,"SELECT gerechtnaam FROM Gerecht WHERE gerechtnaam LIKE '%$zoek_gerecht%'");
			//output gezochte gerecht
			echo "<strong>Gerechten overeenkomend met: </strong>" . $zoek_gerecht . "<br />";
			while($row=mysqli_fetch_array($gevonden_gerecht))
			{
				echo $row['gerechtnaam'] . "<br />";
			}
		}else{
			echo"";
		}
	}
	// functie met de query om zoekresultaten uit de database te halen en te echoen
	public function zoekIngredient($zoek_ingredient)
	{
		if(!empty($_POST['zoek_ingredient']))
		{
			//Query zoeken op Ingredient
			$gevonden_ingredient = mysqli_query($this->link,"SELECT gerechtnaam,productnaam FROM Ingredient WHERE productnaam LIKE '%$zoek_ingredient%'");
			//output gezochte ingredient
			echo "<strong>Gerechten met ingredient: </strong>" . $zoek_ingredient . "<br />";
			while($row=mysqli_fetch_array($gevonden_ingredient))
			{
				echo $row['gerechtnaam'] . " " .$row['productnaam'] . "<br />";
			}
		}
	}
	// functie met de query om zoekresultaten uit de database te halen en te echoen
	public function zoekBereidingstijd($zoek_bereidingstijd)
	{
		if(!empty($_POST['zoek_bereidingstijd']))
		{
			//Query zoeken op bereidingstijd
			$gevonden_bereidingstijd = mysqli_query($this->link,"SELECT gerechtnaam, bereidingstijd FROM Gerecht WHERE bereidingstijd <= '$zoek_bereidingstijd'");
			//output gezochte Bereidingstijd
			echo "<strong>Gerechten die klaar zijn binnen: </strong>" . $zoek_bereidingstijd . " Min <br />";
			while($row=mysqli_fetch_array($gevonden_bereidingstijd))
			{
				echo $row['gerechtnaam'] . " " .$row['bereidingstijd'] . " Min <br />";
			}
		}
	}
   public function __destruct() {
       
       mysqli_close($this->link)
       OR die("There was a problem disconnecting from the database.");
   }
   
}

$db = new Database (HOST, USERNAME, PASSWORD, DATABASE);

?>