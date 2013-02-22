<?php
require_once 'lib/foursquare/EpiCurl.php';
require_once 'lib/foursquare/EpiFoursquare.php';

class FoursquareProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $foursquare;
		$this->config = $foursquare;
	}
	
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		global $foursquare;
		
		$foursquareapi = new EpiFoursquare($this->config["clientID"], $this->config["clientSecret"], $this->config["accesstoken"]);

		$checkin = $foursquareapi->get('/users/self');
		$checkins 	= json_decode($checkin->responseText)->response->user->checkins->count;
		$lat		= json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lat;
		$lng		= json_decode($checkin->responseText)->response->user->checkins->items[0]->venue->location->lng;
		
		$data = array(
			"checkins" => $checkins,
			"latitude" => $lat,
			"longitude" => $lng
			);
		return $data;
	}
}


