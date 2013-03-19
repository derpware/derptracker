<?php
define("BASE_PATH", dirname(__FILE__));

// Configuration storage
require_once BASE_PATH.'/ConfigProvider.interface.php';
require_once BASE_PATH.'/PHPFileConfig.class.php';
ConfigProvider::create("PHPFileConfig");

// Base Plugin classes
require_once BASE_PATH.'/DataProvider.class.php';
require_once BASE_PATH.'/StorageProvider.class.php';

// Data Providers
include(BASE_PATH.'/provider/foursquare.php');
include(BASE_PATH.'/provider/trakt.php');
include(BASE_PATH.'/provider/putio.php');
include(BASE_PATH.'/provider/withings.php');
include(BASE_PATH.'/provider/appnet.php');
include(BASE_PATH.'/provider/mail.php');
include(BASE_PATH.'/provider/github.php');

// Storage Providers
include(BASE_PATH.'/storage/CosmStorage.class.php');
include(BASE_PATH.'/storage/MongoStorage.class.php');

// Find all storage providers
$datastore_classes = array_filter(get_declared_classes(), function($className) {
	return in_array('StorageProvider', class_parents($className));
});

// Instanciate all storage providers
$datastores = array();
foreach ($datastore_classes as $datastore_class) {
	if ($datastore_class::isActive()) {
		$datastore = new $datastore_class();
		$datastores[] = $datastore;
	}
}

// find all data providers
$providers = array_filter(get_declared_classes(), function($className) {
	return in_array('DataProvider', class_parents($className));
});

// get data from each data provider, and push it to the storage providers
foreach ($providers as $provider_class) {
	$provider = new $provider_class();
	if ($provider->isActive()) {
		foreach ($datastores as $datastore) {
			$meta = $provider->getMetaData();
			$raw = $provider->getRawData();
			$datastore->putData($provider, $meta, $raw);
		}
	}
}

