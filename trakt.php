<?php
require_once 'lib/trakt/trakt.php';

class TraktProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $trakt;
		$this->config = $trakt;
	}
	
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		$traktapi = new Trakt($this->config["apikey"]);
		$traktapi->setAuth($this->config["username"], $this->config["password"]);
		
		$profile = $traktapi->userProfile($this->config["username"]);

		$episodesWatchedUnique  = $profile["stats"]["episodes"]["watched_unique"];
		$episodesWatched 	= $profile["stats"]["episodes"]["watched"];
		$episodesScrobbles	= $profile["stats"]["episodes"]["scrobbles"];
		$episodesScrobblesUnique = $profile["stats"]["episodes"]["scrobbles_unique"];
		$episodesCheckins	= $profile["stats"]["episodes"]["checkins"];
		$episodesCheckinsUnique = $profile["stats"]["episodes"]["checkins_unique"];
		$episodesSeen		= $profile["stats"]["episodes"]["seen"];
		$episodesUnwatched	= $profile["stats"]["episodes"]["unwatched"];
		$episodesCollection	= $profile["stats"]["episodes"]["collection"];
		$episodesShouts		= $profile["stats"]["episodes"]["shouts"];
		$episodesLoved		= $profile["stats"]["episodes"]["loved"];
		$episodesHated		= $profile["stats"]["episodes"]["hated"];

		$showsLibrary		= $profile["stats"]["shows"]["library"];
		$showsWatched		= $profile["stats"]["shows"]["watched"];
		$showsCollection	= $profile["stats"]["shows"]["collection"];
		$showsShouts		= $profile["stats"]["shows"]["shouts"];
		$showsLoved		= $profile["stats"]["shows"]["loved"];
		$showsHated		= $profile["stats"]["shows"]["hated"];

		$moviesWatchedUnique	= $profile["stats"]["movies"]["watched_unique"];
		$moviesWatched		= $profile["stats"]["movies"]["watched"];
		$moviesScrobbles	= $profile["stats"]["movies"]["scrobbles"];
		$moviesScrobblesUnique	= $profile["stats"]["movies"]["scrobbles_unique"];
		$moviesCheckins		= $profile["stats"]["movies"]["checkins"];
		$moviesCheckinsUnique	= $profile["stats"]["movies"]["checkins_unique"];
		$moviesSeen		= $profile["stats"]["movies"]["seen"];
		$moviesLibrary		= $profile["stats"]["movies"]["library"];
		$moviesUnwatched	= $profile["stats"]["movies"]["unwatched"];
		$moviesCollection	= $profile["stats"]["movies"]["collection"];
		$moviesShouts		= $profile["stats"]["movies"]["shouts"];
		$moviesLoved		= $profile["stats"]["movies"]["loved"];
		$moviesHated		= $profile["stats"]["movies"]["hated"];

		$friends			= $profile["stats"]["friends"];

		$data = array(
			"episodes_watched_unique" => $episodesWatchedUnique,
			"episodes_watched" => $episodesWatched,
			"episodes_scrobbles" => $episodesScrobbles,
			"episodes_scrobbles_unique" => $episodesScrobblesUnique,
			"episodes_checkins" => $episodesCheckins,
			"episodes_checkins_unique" => $episodesCheckinsUnique,
			"episodes_seen" => $episodesSeen,
			"episodes_unwatched" => $episodesUnwatched,
			"episodes_collection" => $episodesCollection,
			"episodes_shouts" => $episodesShouts,
			"episodes_loved" => $episodesLoved,
			"episodes_hated" => $episodesHated,
		
			"shows_library" => $showsLibrary,
			"shows_watched" => $showsWatched,
			"shows_collection" => $showsCollection,
			"shows_shouts" => $showsShouts,
			"shows_loved" => $showsLoved,
			"shows_hated" => $showsHated,
			
			"movies_watched_unique" => $moviesWatchedUnique,
			"movies_watched" => $moviesWatched,
			"movies_scrobbles" => $moviesScrobbles,
			"movies_scrobbles_unique" => $moviesScrobblesUnique,
			"movies_checkins" => $moviesCheckins,
			"movies_checkins_unique" => $moviesCheckinsUnique,
			"movies_seen" => $moviesSeen,
			"movies_library" => $moviesLibrary,
			"movies_unwatched" => $moviesUnwatched,
			"movies_collection" => $moviesCollection,
			"movies_shouts" => $moviesShouts,
			"movies_loved" => $moviesLoved,
			"movies_hated" => $moviesHated,
			
			"friends" => $friends
		);
		
		return $data;
	}
}
