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
			"checkins" 		=> $user->checkins->count,
			"mayorships" 	=> $user->mayorships->count,
			"friends"		=> $user->friends->count,
			"todos"			=> $user->todos->count,
			"latitude" 		=> $user->checkins->items[0]->venue->location->lat,
			"longitude" 	=> $user->checkins->items[0]->venue->location->lng
			);
		$this->rawdata = array(
			"checkin"		=> $user->checkins->items[0]
			);
	}

}
