<?php
require_once BASE_PATH . '/lib/withings/wbs.php';

class WithingsProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $withings;
		$this->config = $withings;
	}
	
	function getName() {
		return "withings";
	}
		
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		global $withings;

		$wbs = new wbs_Account();
		$wbs->setUserEmail($this->config["mail"]);
		$wbs->setUserPassword($this->config["password"]);

		$usersList = $wbs->getUsersList();
		$user = $usersList[$this->config["userid"]];
		$user->setLimit(1);
		$measuresgroups = $user->getMeasures();
		$group = $measuresgroups[0];
		$measures = $group->getMeasures();

		$data = array(
			"weight" 			=> $measures[0]->getValue(),
			"fat_free_mass"		=> $measures[1]->getValue(),
			"fat_ratio"			=> $measures[2]->getValue(),
			"fat_mass_weight" 	=> $measures[3]->getValue()
			);
		return $data;
	}
}
