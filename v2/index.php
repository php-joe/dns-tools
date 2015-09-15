<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require_once('includes/controllers.php');

//include('views/_header.php');


$q = $_GET['q']; //query method
$a = $_GET['a']; //query action (ajax)


if ($q=="dnslookup") {
    include('views/_header.php');
    include('views/domainlookup.php');
    include('views/_footer.php');
}
elseif ($q=="ajax"){
    ini_set('display_errors', 0);
    $domain = actualDomain($_GET['domain']);


    if ($a=="ip"){ print ipLookup($domain); }
    if ($a=="madwireSystem"){ print check_madwire_ip($domain); }
    if ($a=="bcStyles"){ print check_bc_styles($domain); }
    if ($a=="dnsA") { print "<pre>". diga($domain) . "</pre>"; }
    if ($a=="whois") { print "<pre>". whois($domain). "</pre>";}
    if ($a=="dnsMX") { print "<pre>". digmx($domain). "</pre>";}
    if ($a=="ipWhois") { print "<pre>". ipWhois($domain). "</pre>";}
}
else {
    include('views/_header.php');
	include('views/home.php');
    include('views/_footer.php');
}




?>