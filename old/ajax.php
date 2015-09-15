<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);


require_once('includes/controllers.php');
include('includes/tools.php');
include('views/_header.php');
include('includes/whois.php');

$q = $_GET['q'];

if ($q) { call_user_func($q, $_GET); }
else {
	include('views/home.php');
}

include('views/_footer.php');
