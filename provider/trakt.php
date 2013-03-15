<?php
require_once BASE_PATH . '/lib/trakt/trakt.php';

class TraktProvider extends DataProvider {
	protected $name = "trakt";
	
	function getData() {
		$traktapi = new Trakt($this->config["apikey"]);
		$traktapi->setAuth($this->config["username"], $this->config["password"]);
		
		$profile = $traktapi->userProfile($this->config["username"]);

		$data = $profile["stats"];
		
		return $data;
	}
}
