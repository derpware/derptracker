<?php

class GithubProvider extends DataProvider {
	protected $name = "github";
	
	protected function fetchData() {
		$data = array();
		
		$json = file_get_contents("https://{$this->config["username"]}:{$this->config["password"]}@api.github.com/user");
		$user = json_decode($json);
		
		$data["public_repos"] = $user->public_repos;
		$data["public_gists"] = $user->public_gists;
		$data["followers"] = $user->followers;
		$data["following"] = $user->following;
		
		$json = file_get_contents("https://{$this->config["username"]}:{$this->config["password"]}@api.github.com/user/orgs");
		$organizations = json_decode($json);
		$data["organizations"] = count($organizations);
		
		$json = file_get_contents("https://{$this->config["username"]}:{$this->config["password"]}@api.github.com/user/starred");
		$starred = json_decode($json);
		$data["starred"] = count($starred);
		
		$json = file_get_contents("https://{$this->config["username"]}:{$this->config["password"]}@api.github.com/user/subscriptions");
		$subscriptions = json_decode($json);
		$data["subscriptions"] = count($subscriptions);
		
		$this->metadata = $data;
	}
	
}
