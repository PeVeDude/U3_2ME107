<?php 			

function getPics(dish) //Funktion fšr att hŠmta alla poster i databasen, loopa igenom dem, skicka en fšrfrŒgan till flickr samt bygga en lŠnk till varje bild som hittas
{
//$strQuery		= 'SELECT * FROM posts'; //HŠmtar alla poster
//$posts = $this->MySQL->getData($strQuery);

//$dishArray		=	explode(",", $_GET['dishes']);
$sDish = dish;


	$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=e60e15a5580632018c6567fd7bb65130?q={$sDish}&per_page=1&page=1&format=php_serial"; //SškstrŠng fšr varje post ifrŒn databasen
	$result = file_get_contents($url); //Skickar sškstrŠngen
	
	$result_obj = unserialize($result); //Formaterar $result sŒ att det ska kunna anvŠndas i nŠsta loop dŠr bild urlen ska byggas
	$imgUrl = null;

	foreach($result_obj[photos][photo] as $r) //KlŠttra till rŠtt stŠlle i $result_obj och bygger bild url av informationen som finns dŠr
	{
		$imgUrl = "http://farm{$r['farm']}.static.flickr.com/{$r['server']}/{$r['id']}_{$r['secret']}.jpg"; //Url till bild
	}
	//$i['img'] = $imgUrl; //Bildens url lŠggs till i den nuvarande posten under 'img'

echo $imgUrl;

//$posts = json_encode($posts); //Posts frŒn databasen (nu Šven med bild url) json kodas
//print_r($posts); //Skriver ut posts pŒ sidan, detta fšr att informationen ska kunna returneras pŒ rŠtt sŠtt
} //End getArticles


?>