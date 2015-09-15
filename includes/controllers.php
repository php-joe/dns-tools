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

function certificate($d){
	return shell_exec("gnutls-cli --print-cert ".$d." < /dev/null");

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL,"https://".$d);
    // curl_setopt($ch, CURLOPT_STDERR, $fp);
    // curl_setopt($ch, CURLOPT_CERTINFO, 1);
    // curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    // curl_setopt($ch, CURLOPT_VERBOSE, 1);
    // curl_setopt($ch, CURLOPT_HEADER, 1);
    // curl_setopt($ch, CURLOPT_NOBODY, 1);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
    // curl_setopt($ch, CURLOPT_SSLVERSION,3);
    // $result = curl_exec($ch);
    // $str='';
    // curl_errno($ch)==0 or $result = "Error:".curl_errno($ch)." ".curl_error($ch);

    // fseek($fp, 0);//rewind
    
    // while(strlen($str.=fread($fp,8192))==8192);
    // return $result;
    

}

function ipgeo($d){
        $ipaddress = ipLookup($d);
        $url = "http://www.telize.com/geoip/".$ipaddress;
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $geoip_json=curl_exec($ch);
        // Closing
        curl_close($ch);

        // get the results and json_decode the answer
        $geoip_data = (json_decode($geoip_json, true));

        return(substr(substr(print_r($geoip_data,true), 7),0,-2));


}