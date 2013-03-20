<?php

class MongoDBStorage extends StorageProvider {

	protected static $name = "mongodb";
	
	protected $mongo;
	protected $db;

	public function putData($provider, $metadata, $rawdata) {
		$provider = $provider->getName();
		$timestamp = new MongoDate();
		// Metadata
		$metacollection = $this->db->$provider->meta;
		$lastmeta = $metacollection->find()->sort(array('_timestamp' => -1))->limit(1);
		foreach ($lastmeta as $val) {
			unset($val['_timestamp'], $val['_id']);
			$lastmeta = $val;
		}
		if($metadata != $lastmeta){
			$metadata["_timestamp"] = $timestamp;
			$metacollection->insert($metadata);
		}

		// Rawdata
		$rawcollection = $this->db->$provider->raw;
		$lastraw = $rawcollection->find()->sort(array('_timestamp' => -1))->limit(1);
		foreach ($lastraw as $val) {
			unset($val['_timestamp'], $val['_id']);
			$lastraw = $val;
		}
		if($rawdata != $lastraw){
			$rawdata["_timestamp"] = $timestamp;
			$rawcollection->insert($rawdata);
		}
	}

	public function init(){
		$this->mongo = new Mongo();
	 	$this->db = $this->mongo->derptracker; 
	}
}

