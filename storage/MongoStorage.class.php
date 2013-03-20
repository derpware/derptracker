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
		$metadata["_timestamp"] = $timestamp;
		$metacollection->insert($metadata);

		// Rawdata
		$rawcollection = $this->db->$provider->raw;
		$rawdata["_timestamp"] = $timestamp;
		$rawcollection->insert($rawdata);
	}

	public function init(){
		$this->mongo = new Mongo();
	 	$this->db = $this->mongo->derptracker; 
	}
}

