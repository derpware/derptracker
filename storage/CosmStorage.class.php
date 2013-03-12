<?php
require_once BASE_PATH.'/lib/cosm/PachubeAPI.php';

class CosmStorage extends StorageProvider {
	protected $name = "cosm";

	public function putData($data, $provider) {
		foreach ($data as $item => $value) {
			$streams[] = array("id" => "$item", "current_value" => "$value");
		}

		$cosm_data = array("datastreams" => $streams);
		$cosm_json = json_encode($cosm_data);
		
		$pachube = new PachubeAPI($this->config["apikey"]);
		$pachube->updateFeed("json", $this->config["feeds"][$provider->getName()], $cosm_json);
	}
}
