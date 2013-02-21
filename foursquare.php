<?php
require_once 'lib/foursquare/EpiCurl.php';
require_once 'lib/foursquare/EpiFoursquare.php';

$pachube = new PachubeAPI($cosm["apikey"]);

$foursquareapi = new EpiFoursquare($foursquare["clientID"], $foursquare["clientSecret"], $foursquare["accesstoken"]);
$checkin = $foursquareapi->get('/users/self');
$checkins 	= json_decode($checkin->responseText)->response->user->checkins->count;
$lat		= json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lat;
$lng		= json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lng;

$pachube->updateDatastream("csv", $foursquare["feedid"], "checkins", $checkins);
$pachube->updateDatastream("csv", $foursquare["feedid"], "latitude", $lat);
$pachube->updateDatastream("csv", $foursquare["feedid"], "longitude", $lng);
