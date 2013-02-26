<?php
require_once 'config.php';
require_once 'lib/cosm/PachubeAPI.php';
require_once 'DataProvider.interface.php';

include('provider/foursquare.php');
include('provider/trakt.php');
include('provider/putio.php');
include('provider/withings.php');
include('provider/appnet.php');

function sendToCosm($data, $provider) {	
	global $cosm;
	
	foreach ($data as $item => $value) {
		$streams[] = array("id" => "$item", "current_value" => "$value");
	}

	$cosm_data = array("datastreams" => $streams);
	$cosm_json = json_encode($cosm_data);
	
	$pachube = new PachubeAPI($cosm["apikey"]);
	$pachube->updateFeed("json", $cosm["feeds"][$provider->getName()], $cosm_json);
}

$providers = array_filter(get_declared_classes(), function($className) {
	return in_array('DataProvider', class_implements($className));
});

foreach ($providers as $provider_class) {
	$provider = new $provider_class();
	if ($provider->isActive()) {
		sendToCosm($provider->getData(), $provider);
	}
}

