<?php
require_once BASE_PATH.'/lib/putio/PutIO/Autoloader.php';

class PutioProvider extends DataProvider {
	protected $name = "putio";
	
	function getData() {
		global $putio;
		
		$putioapi = new PutIO\API($this->config["apikey"]);

		$info = $putioapi->account->info();
		$transfers = $putioapi->transfers->listall();
		$friends = $putioapi->friends->listall();
		$download = 0;
		$upload = 0;
		$transfercount = 0;
		foreach ($transfers as $transfer) {
			$download 	= $download + $transfer["down_speed"];
			$upload 	= $upload + $transfer["up_speed"];
			if($transfer["status"] != "COMPLETED")
				$transfercount++;
		}
		$data = array(
			"storage" => array(
				"avail" 	=> $info["disk"]["avail"],
				"used"		=> $info["disk"]["used"],
				"size"		=> $info["disk"]["size"] ),
			"transfers"	=> array(
				"active"	=> $transfercount,
				"download" => $download,
				"upload"	=> $upload),
			"friends"			=> count($friends)
			);
		return $data;
	}
}
