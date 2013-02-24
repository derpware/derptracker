<?php
require_once 'lib/putio/PutIO/Autoloader.php';

class PutioProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $putio;
		$this->config = $putio;
	}
	
	function getName() {
		return "putio";
	}
		
	function isActive() {
		return $this->config["active"];
	}
	
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
			"storage_avail" 	=> $info["disk"]["avail"],
			"storage_used"		=> $info["disk"]["used"],
			"storage_size"		=> $info["disk"]["size"],
			"active_transfers" 	=> $transfercount,
			"transfer_download" => $download,
			"transfer_upload"	=> $upload,
			"friends"			=> count($friends)
			);
		return $data;
	}
}
