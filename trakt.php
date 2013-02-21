<?php
require_once 'lib/trakt/trakt.php';

$pachube = new PachubeAPI($cosm["apikey"]);

$traktapi = new Trakt($trakt["apikey"]);
$traktapi->setAuth($trakt["username"], $trakt["password"]);

$episodesWatchedUnique  = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["watched_unique"];
$episodesWatched 	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["watched"];
$episodesScrobbles	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["scrobbles"];
$episodesScrobblesUnique = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["scrobbles_unique"];
$episodesCheckins	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["checkins"];
$episodesCheckinsUnique = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["checkins_unique"];
$episodesSeen		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["seen"];
$episodesUnwatched	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["unwatched"];
$episodesCollection	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["collection"];
$episodesShouts		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["shouts"];
$episodesLoved		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["loved"];
$episodesHated		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["hated"];

$showsLibrary		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["library"];
$showsWatched		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["watched"];
$showsCollection	= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["collection"];
$showsShouts		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["shouts"];
$showsLoved		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["loved"];
$showsHated		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["hated"];

$moviesWatchedUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["watched_unique"];
$moviesWatched		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["watched"];
$moviesScrobbles	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["scrobbles"];
$moviesScrobblesUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["scrobbles_unique"];
$moviesCheckins		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["checkins"];
$moviesCheckinsUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["checkins_unique"];
$moviesSeen		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["seen"];
$moviesLibrary		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["library"];
$moviesUnwatched	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["unwatched"];
$moviesCollection	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["collection"];
$moviesShouts		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["shouts"];
$moviesLoved		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["loved"];
$moviesHated		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["hated"];

$friends			= $traktapi->userProfile($trakt["username"])["stats"]["friends"];

$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_watched_unique", $episodesWatchedUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_watched", $episodesWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_scrobbles", $episodesScrobbles);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_scrobbles_unique", $episodesScrobblesUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_checkins", $episodesCheckins);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_checkins_unique", $episodesCheckinsUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_seen", $episodesSeen);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_unwatched", $episodesUnwatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_collection", $episodesCollection);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_shouts", $episodesShouts);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_loved", $episodesLoved);
$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_hated", $episodesHated);

$pachube->updateDatastream("csv", $trakt["feedid"], "shows_library", $showsLibrary);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_watched", $showsWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_collection", $showsCollection);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_shouts", $showsShouts);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_loved", $showsLoved);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_hated", $showsHated);

$pachube->updateDatastream("csv", $trakt["feedid"], "movies_watched_unique", $moviesWatchedUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_watched", $moviesWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_scrobbles", $moviesScrobbles);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_scrobbles_unique", $moviesScrobblesUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_checkins", $moviesCheckins);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_checkins_unique", $moviesCheckinsUnique);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_seen", $moviesSeen);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_library", $moviesLibrary);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_unwatched", $moviesUnwatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_collection", $moviesCollection);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_shouts", $moviesShouts);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_loved", $moviesLoved);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_hated", $moviesHated);

$pachube->updateDatastream("csv", $trakt["feedid"], "friends", $friends);
