<?php 			

function getPics($dish) //Funktion f�r att h�mta alla poster i databasen, loopa igenom dem, skicka en f�rfr�gan till flickr samt bygga en l�nk till varje bild som hittas
{

	$sDish = urlencode($dish);

	$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=e60e15a5580632018c6567fd7bb65130&text={$sDish}&per_page=1&page=1&format=php_serial";

	$result = file_get_contents($url); 
	$result_obj = unserialize($result); 

	$imgUrl = null;

	if(@$result_obj[photos][total] != 0) {
		$imgUrl = "http://farm{$result_obj['photos']['photo'][0]['farm']}.static.flickr.com/{$result_obj['photos']['photo'][0]['server']}/{$result_obj['photos']['photo'][0]['id']}_{$result_obj['photos']['photo'][0]['secret']}.jpg";
		echo "<img src=". $imgUrl .">";
	}
	else {
		echo "<p>No photo found</p>";
	}
} 


?>