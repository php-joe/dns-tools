

<h4>DNS Lookup</h4>
	<form method="GET" action="#" >
		Domain Name: 
		<input name="domain" placeholder="http://www.domain.com" style="width: 500px;" value="<?php print $_GET['domain']; ?>" autofocus>
		<input name="q" type="hidden" value="dnslookup" />
		<input type="submit" />
	</form>
