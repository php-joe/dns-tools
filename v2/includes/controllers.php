<?php


function actualDomain($o){

	$a = str_replace("/","",str_replace("http://","", $o));
	//$b = str_replace("www.","",$a);
	return $a;
}

function ipLookup($o){
	
	return gethostbyname(actualDomain($o));
	
}
	
function get_madwire_ips(){
	// returns an array of all Madwire IP's
	$m = file_get_contents("https://docs.google.com/spreadsheet/pub?key=0AgyZbtxlxFYYdHJrOWczNXJoVVhyMm9QUzdrcXkyN2c&output=csv");

	$Data = str_getcsv($m,"\n");
	foreach($Data as &$Row) $d[] = str_getcsv($Row);
	

	return $d;

}

function check_madwire_ip($domain){
	$ip = ipLookup(actualDomain($domain));

	$m = get_madwire_ips();
	$found = false;
	foreach($m as $row){
		if ($ip == $row[0]){
			$found=$row;
		}

	}
	if ($found){
		return "Yes, ".$found[0]." - ".$found[1]." - ".$found[2]. " - ". $found[3];
	}
	else {
		return "No";
	}
}

function check_bc_styles($d){
	$domain = actualDomain($d);
	$doc = new DOMDocument();
	$doc->loadHTMLFile("http://".$domain);

	if (strpos($doc->saveHTML(),'/css/madstyles.php') !== false) {
	    $r['bcstyles'] = "Yes";
	}
	else {
		$r['bcstyles'] = "No";
	}
	return $r['bcstyles'];
}

function whois($d){

	return shell_exec('/usr/bin/whois '. escapeshellarg(str_replace("www.","",$d)));


}

function diga($d){

	return shell_exec("/usr/bin/dig a " . escapeshellarg(str_replace("www.","",$d)));

}

function digmx($d){

	return shell_exec("/usr/bin/dig mx " . escapeshellarg(str_replace("www.","",$d)));

}
function ipWhois($d){
	
	return shell_exec("/usr/bin/whois ". ipLookup($d));

}



