<?php 			

function getPics(dish) //Funktion f�r att h�mta alla poster i databasen, loopa igenom dem, skicka en f�rfr�gan till flickr samt bygga en l�nk till varje bild som hittas
{
//$strQuery		= 'SELECT * FROM posts'; //H�mtar alla poster
//$posts = $this->MySQL->getData($strQuery);

//$dishArray		=	explode(",", $_GET['dishes']);
$sDish = dish;


	$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=e60e15a5580632018c6567fd7bb65130?q={$sDish}&per_page=1&page=1&format=php_serial"; //S�kstr�ng f�r varje post ifr�n databasen
	$result = file_get_contents($url); //Skickar s�kstr�ngen
	
	$result_obj = unserialize($result); //Formaterar $result s� att det ska kunna anv�ndas i n�sta loop d�r bild urlen ska byggas
	$imgUrl = null;

	foreach($result_obj[photos][photo] as $r) //Kl�ttra till r�tt st�lle i $result_obj och bygger bild url av informationen som finns d�r
	{
		$imgUrl = "http://farm{$r['farm']}.static.flickr.com/{$r['server']}/{$r['id']}_{$r['secret']}.jpg"; //Url till bild
	}
	//$i['img'] = $imgUrl; //Bildens url l�ggs till i den nuvarande posten under 'img'

echo "<img src=". $imgUrl .">";

//$posts = json_encode($posts); //Posts fr�n databasen (nu �ven med bild url) json kodas
//print_r($posts); //Skriver ut posts p� sidan, detta f�r att informationen ska kunna returneras p� r�tt s�tt
} //End getArticles


?>