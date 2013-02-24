<?php
require_once 'lib/withings/wbs.php';

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

		$data = array(
			"weight" 			=> $group->getMeasures()[0]->getValue(),
			"fat_free_mass"		=> $group->getMeasures()[1]->getValue(),
			"fat_ratio"			=> $group->getMeasures()[2]->getValue(),
			"fat_mass_weight" 	=> $group->getMeasures()[3]->getValue()
			);
		return $data;
	}
}
