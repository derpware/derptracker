<?php
require_once 'config.php';

if($foursquare["active"])
	include('foursquare.php');

if($trakt["active"])
	include('trakt.php');