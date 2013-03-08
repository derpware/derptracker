<?php
define("BASE_PATH", dirname(__FILE__));

require_once BASE_PATH.'/ConfigProvider.interface.php';
require_once BASE_PATH.'/PHPFileConfig.class.php';
ConfigProvider::create("PHPFileConfig");

require_once BASE_PATH.'/lib/cosm/PachubeAPI.php';
require_once BASE_PATH.'/DataProvider.interface.php';

include(BASE_PATH.'/provider/foursquare.php');
include(BASE_PATH.'/provider/trakt.php');
include(BASE_PATH.'/provider/putio.php');
include(BASE_PATH.'/provider/withings.php');
include(BASE_PATH.'/provider/appnet.php');
include(BASE_PATH.'/provider/mail.php');
include(BASE_PATH.'/provider/github.php');


function sendToCosm($data, $provider) {	
	$cosm = ConfigProvider::getInstance()->get("cosm");
	
	foreach ($data as $item => $value) {
		$streams[] = array("id" => "$item", "current_value" => "$value");
	}

	$cosm_data = array("datastreams" => $streams);
	$cosm_json = json_encode($cosm_data);
	
	$pachube = new PachubeAPI($cosm["apikey"]);
	$pachube->updateFeed("json", $cosm["feeds"][$provider->getName()], $cosm_json);
}

$providers = array_filter(get_declared_classes(), function($className) {
	return in_array('DataProvider', class_parents($className));
});

foreach ($providers as $provider_class) {
	$provider = new $provider_class();
	if ($provider->isActive()) {
		sendToCosm($provider->getData(), $provider);
	}
}

