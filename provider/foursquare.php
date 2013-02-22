<?php
require_once 'lib/foursquare/EpiCurl.php';
require_once 'lib/foursquare/EpiFoursquare.php';

class FoursquareProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $foursquare;
		$this->config = $foursquare;
	}
	
	function getName() {
		return "foursquare";
	}
		
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		global $foursquare;
		
		$foursquareapi = new EpiFoursquare($this->config["clientID"], $this->config["clientSecret"], $this->config["accesstoken"]);

		$checkin = $foursquareapi->get('/users/self');
		$user = json_decode($checkin->responseText)->response->user;
		
		$data = array(
			"checkins" 		=> json_decode($checkin->responseText)->response->user->checkins->count,
			"mayorships" 	=> json_decode($checkin->responseText)->response->user->mayorships->count,
			"friends"		=> json_decode($checkin->responseText)->response->user->friends->count,
			"todos"			=> json_decode($checkin->responseText)->response->user->todos->count,
			"latitude" => $user->checkins->items[0]->venue->location->lat,
			"longitude" => $user->checkins->items[0]->venue->location->lng
			);
		return $data;
	}
}
