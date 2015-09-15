<?php


function dnslookup($o){
	$domain = str_replace("/","",str_replace("http://","", $o['domain']));
	$ip = gethostbyname($domain);
	

	

	$r = array(
		'domain' => $domain,
		'ip' => $ip,
		'madwireip' => check_madwire_ip($ip),
		'whois' => whois(str_replace('www.','',$domain)),
                'ipwhois' => whois($ip)

	);



	$doc = new DOMDocument();
	$doc->loadHTMLFile("http://".$domain);

	if (strpos($doc->saveHTML(),'/css/madstyles.php') !== false) {
	    $r['bcstyles'] = "Yes";
	}
	else {
		$r['bcstyles'] = "No";
	}

	// here comes the view!  (INSIDE THE CONTROLLER!)
	?>
	<h1>Domain Details</h1>

	<p>
		<table style="width: 100%">
			<tr>
				<td class="lbl">Domain Name</td>
				<td><?php print $r['domain'] ?></td>
			</tr>
			<tr>
				<td class="lbl">ip</td>
				<td><?php print $r['ip'] ?></td>
			</tr>
			<tr>
				<td class="lbl">Madwire System?</td>
				<td><?php if ($r['madwireip']) { print "Yes, ". $r['madwireip'][1].", ".$r['madwireip'][2]. ", ". $r['madwireip'][3]; } else { print "No"; } ?></td>
			</tr>
			<tr>
				<td class="lbl">BC Mad Style Present?</td>
				<td><?php print $r['bcstyles']; ?></td>
			<tr>
				<td class='lbl'>DNS A Record</td>
				<td><?php print "<pre>". diga($domain)."</pre>"; ?></td>
			</tr>
			<tr>
				<td class='lbl'>DNS MX Records</td>
				<td><?php print "<pre>". digmx($domain). "</pre>"; ?></td>
			</tr>
			<tr>
				<td class='lbl'>WHOIS</td>
				<td><pre><?php print $r['whois'] ?></pre></td>
			</tr>
			<tr>
				<td class='lbl'>IP Whois</td>
				<td><pre><?php print $r['ipwhois'] ?></pre></td>
			</tr>
			<tr>
				<td class='lbl'>ARIN</td>
				<td>
					<form action="http://whois.arin.net/ui/query.do" method="post" name="whois_query" id="whois_query"  target="_blank">
						<input type="hidden" name="xslt" value="http://whois.arin.net/ui/arin.xsl">
						<input type="hidden" name="flushCache" value="false">
						<input type="hidden" id="queryinput" name="queryinput" value="<?php print $r['ip'] ?>">
						<input id="whoisSubmitButton" type="submit" name="" value="Arin WHOIS">
					</form>


				</td>
			</tr>

				<td class='lbl'>RIPE</td>
				<td>
					<form method="get" action="https://apps.db.ripe.net/search/query.html" target="_blank">
				      <input type="hidden" name="searchtext" id="searchtext" class="searchField" size="20" value="<?php print $r['ip']; ?>">
				      <input type="submit" class="searchButton" name="search:doSearch" alt="submit search" value="RIPE Whois">
				    </form>
				</td>
			</tr>
			<tr>
				<td class="lbl">APNIC</td>
				<td>
					<form method="post" action="http://wq.apnic.net/apnic-bin/whois.pl" id="whoisform" target="_blank">
	                    <input title="WHOIS search" name="searchtext" class="search" value="<?php print $r['ip']; ?>" type="hidden">
	                    <input name="whois" title="Search" value="APNIC Whois" type="submit">
                    </form>
              	</td>
			</tr>
		</table>

	</p>



	<?php


	
}
