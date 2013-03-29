<?php
require_once BASE_PATH . '/lib/trakt/trakt.php';

class TraktProvider extends DataProvider {
	protected $name = "trakt";
	
	protected function fetchData() {
		$traktapi = new Trakt($this->config["apikey"]);
		$traktapi->setAuth($this->config["username"], $this->config["password"]);
		
		$profile = $traktapi->userProfile($this->config["username"]);

		$watching = $profile["watching"];
		if(empty($watching))
			$watching = NULL;

		$this->metadata = $profile["stats"];
		$this->rawdata 	= array(
			"watching"	=> $watching,
			"watched"	=> $profile["watched"][0]
			);
	}
}
