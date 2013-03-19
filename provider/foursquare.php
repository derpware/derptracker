<?php
require_once BASE_PATH.'/lib/foursquare/EpiCurl.php';
require_once BASE_PATH.'/lib/foursquare/EpiFoursquare.php';

class FoursquareProvider extends DataProvider {
	protected $name = "foursquare";
	
	function fetchData() {
		
		$foursquareapi = new EpiFoursquare($this->config["clientID"], $this->config["clientSecret"], $this->config["accesstoken"]);

		$checkin = $foursquareapi->get('/users/self');
		$user = json_decode($checkin->responseText)->response->user;
		
		$this->metadata = array(
			"checkins" 		=> json_decode($checkin->responseText)->response->user->checkins->count,
			"mayorships" 	=> json_decode($checkin->responseText)->response->user->mayorships->count,
			"friends"		=> json_decode($checkin->responseText)->response->user->friends->count,
			"todos"			=> json_decode($checkin->responseText)->response->user->todos->count,
			"latitude" => $user->checkins->items[0]->venue->location->lat,
			"longitude" => $user->checkins->items[0]->venue->location->lng
			);
	}

}
