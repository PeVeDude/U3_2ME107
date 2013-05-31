<?php 			

function getPics(dish) //Funktion för att hämta alla poster i databasen, loopa igenom dem, skicka en förfrågan till flickr samt bygga en länk till varje bild som hittas
{
//$strQuery		= 'SELECT * FROM posts'; //Hämtar alla poster
//$posts = $this->MySQL->getData($strQuery);

//$dishArray		=	explode(",", $_GET['dishes']);
$sDish = dish;


	$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=e60e15a5580632018c6567fd7bb65130?q={$sDish}&per_page=1&page=1&format=php_serial"; //Söksträng för varje post ifrån databasen
	$result = file_get_contents($url); //Skickar söksträngen
	
	$result_obj = unserialize($result); //Formaterar $result så att det ska kunna användas i nästa loop där bild urlen ska byggas
	$imgUrl = null;

	foreach($result_obj[photos][photo] as $r) //Klättra till rätt ställe i $result_obj och bygger bild url av informationen som finns där
	{
		$imgUrl = "http://farm{$r['farm']}.static.flickr.com/{$r['server']}/{$r['id']}_{$r['secret']}.jpg"; //Url till bild
	}
	//$i['img'] = $imgUrl; //Bildens url läggs till i den nuvarande posten under 'img'

echo "<img src=". $imgUrl .">";

//$posts = json_encode($posts); //Posts från databasen (nu även med bild url) json kodas
//print_r($posts); //Skriver ut posts på sidan, detta för att informationen ska kunna returneras på rätt sätt
} //End getArticles


?>