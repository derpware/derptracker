<?php
require_once 'lib/trakt/trakt.php';

class TraktProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $trakt;
		$this->config = $trakt;
	}
	
	function getName() {
		return "trakt";
	}
	
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		$traktapi = new Trakt($this->config["apikey"]);
		$traktapi->setAuth($this->config["username"], $this->config["password"]);
		
		$profile = $traktapi->userProfile($this->config["username"]);

		$data = array(
			"episodes_watched_unique" => $profile["stats"]["episodes"]["watched_unique"],
			"episodes_watched" => $profile["stats"]["episodes"]["watched"],
			"episodes_scrobbles" => $profile["stats"]["episodes"]["scrobbles"],
			"episodes_scrobbles_unique" => $profile["stats"]["episodes"]["scrobbles_unique"],
			"episodes_checkins" => $profile["stats"]["episodes"]["checkins"],
			"episodes_checkins_unique" => $profile["stats"]["episodes"]["checkins_unique"],
			"episodes_seen" => $profile["stats"]["episodes"]["seen"],
			"episodes_unwatched" => $profile["stats"]["episodes"]["unwatched"],
			"episodes_collection" => $profile["stats"]["episodes"]["collection"],
			"episodes_shouts" => $profile["stats"]["episodes"]["shouts"],
			"episodes_loved" => $profile["stats"]["episodes"]["loved"],
			"episodes_hated" => $profile["stats"]["episodes"]["hated"],
		
			"shows_library" => $profile["stats"]["shows"]["library"],
			"shows_watched" => $profile["stats"]["shows"]["watched"],
			"shows_collection" => $profile["stats"]["shows"]["collection"],
			"shows_shouts" => $profile["stats"]["shows"]["shouts"],
			"shows_loved" => $profile["stats"]["shows"]["loved"],
			"shows_hated" => $profile["stats"]["shows"]["hated"],
			
			"movies_watched_unique" => $profile["stats"]["movies"]["watched_unique"],
			"movies_watched" => $profile["stats"]["movies"]["watched"],
			"movies_scrobbles" => $profile["stats"]["movies"]["scrobbles"],
			"movies_scrobbles_unique" => $profile["stats"]["movies"]["scrobbles_unique"],
			"movies_checkins" => $profile["stats"]["movies"]["checkins"],
			"movies_checkins_unique" => $profile["stats"]["movies"]["checkins_unique"],
			"movies_seen" => $profile["stats"]["movies"]["seen"],
			"movies_library" => $profile["stats"]["movies"]["library"],
			"movies_unwatched" => $profile["stats"]["movies"]["unwatched"],
			"movies_collection" => $profile["stats"]["movies"]["collection"],
			"movies_shouts" => $profile["stats"]["movies"]["shouts"],
			"movies_loved" => $profile["stats"]["movies"]["loved"],
			"movies_hated" => $profile["stats"]["movies"]["hated"],
			
			"friends" => $profile["stats"]["friends"]
		);
		
		return $data;
	}
}
