<?php
require_once 'config.php';
require_once 'lib/cosm/PachubeAPI.php';
require_once 'DataProvider.interface.php';

include('foursquare.php');
include('trakt.php');

$providers = array_filter(get_declared_classes(), function($className) {
	return in_array('DataProvider', class_implements($className));
});

foreach ($providers as $provider_class) {
	$provider = new $provider_class();
	if ($provider->isActive()) {
		print_r($provider->getData());
	}
}
	
