<?php
define("BASE_PATH", dirname(__FILE__));

require_once BASE_PATH.'/ConfigProvider.interface.php';
require_once BASE_PATH.'/PHPFileConfig.class.php';
ConfigProvider::create("PHPFileConfig");

require_once BASE_PATH.'/DataProvider.class.php';
require_once BASE_PATH.'/StorageProvider.class.php';

include(BASE_PATH.'/provider/foursquare.php');
include(BASE_PATH.'/provider/trakt.php');
include(BASE_PATH.'/provider/putio.php');
include(BASE_PATH.'/provider/withings.php');
include(BASE_PATH.'/provider/appnet.php');
include(BASE_PATH.'/provider/mail.php');
include(BASE_PATH.'/provider/github.php');

include(BASE_PATH.'/storage/CosmStorage.class.php');


$datastore_classes = array_filter(get_declared_classes(), function($className) {
	return in_array('StorageProvider', class_parents($className));
});

$datastores = array();
foreach ($datastore_classes as $datastore_class) {
	$datastores[] = new $datastore_class();
}

$providers = array_filter(get_declared_classes(), function($className) {
	return in_array('DataProvider', class_parents($className));
});

foreach ($providers as $provider_class) {
	$provider = new $provider_class();
	if ($provider->isActive()) {
		foreach ($datastores as $datastore) {
			$datastore->putData($provider->getData(), $provider);
		}
	}
}

