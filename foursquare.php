<?php
require_once 'lib/foursquare/EpiCurl.php';
require_once 'lib/foursquare/EpiFoursquare.php';

$pachube = new PachubeAPI($cosm["apikey"]);

$foursquareapi = new EpiFoursquare($foursquare["clientID"], $foursquare["clientSecret"], $foursquare["accesstoken"]);
$checkin = $foursquareapi->get('/users/self');

$stream = array(
	"checkins" 		=> json_decode($checkin->responseText)->response->user->checkins->count,
	"mayorships" 	=> json_decode($checkin->responseText)->response->user->mayorships->count,
	"friends"		=> json_decode($checkin->responseText)->response->user->friends->count,
	"todos"			=> json_decode($checkin->responseText)->response->user->todos->count,
	"latitude"		=> json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lat,
	"longitude"		=> json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lng
	);
foreach ($stream as $item => $value) {
	$streamitems[] = array("id" => "$item", "current_value" => "$value");
}

$data = array("datastreams" => $streamitems);
$data = json_encode($data);
var_dump($data);
$pachube->updateFeed("json", $foursquare["feedid"], $data);