<?php


function get_madwire_ips(){
	// returns an array of all Madwire IP's
	$m = file_get_contents("https://docs.google.com/spreadsheet/pub?key=0AgyZbtxlxFYYdHJrOWczNXJoVVhyMm9QUzdrcXkyN2c&output=csv");

	$Data = str_getcsv($m,"\n");
	foreach($Data as &$Row) $d[] = str_getcsv($Row);
	

	return $d;

}

function check_madwire_ip($ip){
	$m = get_madwire_ips();
	$found = false;
	foreach($m as $row){
		if ($ip == $row[0]){
			$found=$row;
		}

	}
	return $found;

}


function whois($d){

	return shell_exec('/usr/bin/whois '. escapeshellarg($d));


}

function diga($d){

	return shell_exec("/usr/bin/dig a " . escapeshellarg(str_replace("www.","",$d)));

}

function digmx($d){

	return shell_exec("/usr/bin/dig mx " . escapeshellarg(str_replace("www.","",$d)));

}

//arin

?>