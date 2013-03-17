<?php
require_once BASE_PATH.'/lib/cosm/PachubeAPI.php';

class CosmStorage extends StorageProvider {
	protected static $name = "cosm";

	public function putData($data, $provider) {
		foreach ($this->collapse($data) as $item => $value) {
			$streams[] = array("id" => "$item", "current_value" => "$value");
		}

		$cosm_data = array("datastreams" => $streams);
		$cosm_json = json_encode($cosm_data);
		
		$pachube = new PachubeAPI($this->config["apikey"]);
		$pachube->updateFeed("json", $this->config["feeds"][$provider->getName()], $cosm_json);
	}
	
	// http://stackoverflow.com/questions/11983141/php-convert-deep-array
	private function collapse($array)	{
		$seperator = "_";
		$result = array();
		foreach ($array as $key => $val) {
			if (is_array($val)) {
				foreach ($this->collapse($val) as $nested_key => $nested_val) {
					$result[$key . $seperator . $nested_key] = $nested_val;
				}
			} else {
				$result[$key] = $val;
			}
		}
		return $result;
	}
}
