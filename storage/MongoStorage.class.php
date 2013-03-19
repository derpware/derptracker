<?php

class MongoDBStorage extends StorageProvider {

	protected static $name = "mongodb";
	
	protected $mongo;
	protected $db;

	public function putData($provider, $metadata, $rawdata) {
		$provider = $provider->getName();
		$collection = $this->db->$provider;
		$metadata["_timestamp"] = new MongoDate();
		$collection->insert($metadata);	
	}

	public function init(){
		$this->mongo = new Mongo();
	 	$this->db = $this->mongo->derptracker; 
	}
}

