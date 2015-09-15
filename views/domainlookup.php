<?php 


$ajaxPlaceholder="<center><img src='images/477.GIF' style='width: 20px; opacity: .5' /></center>";
?>

<h1>Domain Details</h1>

    <p>
        <a href="#ip">IP</a> | <a href="#mwsys">Madwire System?</a> | <a href="#bc">BC Styles?</a> | <a href="#arecord">A Record</a>
        | <a href="#mx">MX Record</a> | <a href="#certificate">SSL Certificate</a> | <a href="#whois">WHOIS</a> | <a href="#ipwhois">IP WHOIS</a>
    </p>
    <br/>
        <table style="width: 100%">
            <tr>
                <th width="15%"></th>
                <th></th>
            </tr>

            <tr>
                <td class="lbl"><a name="domain"></a>Domain Name</td>
                <td><a target="_blank" href="http://<?php print actualDomain($_GET['domain']); ?>"><?php print actualDomain($_GET['domain']); ?></a></td>
            </tr>
            <tr>
                <td class="lbl"><a name="ip"></a>ip</td>
                <td id="getIp"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class="lbl"><a name="mwsys"></a>Madwire System?</td>
                <td id="getMadwire"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class="lbl"><a name="bc"></a>BC Mad Style Present?</td>
                <td id="getBcStyle"><?php print $ajaxPlaceholder ?></td>
            <tr>
                <td class='lbl'><a name="arecord"></a>DNS A Record</td>
                <td id="getDnsA"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class='lbl'><a name="mx"></a>DNS MX Records</td>
                <td id="getDNSMX"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class='lbl'><a name="certificate"></a>SSL Certificate</td>
                <td id="getCert"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class='lbl'><a name="whois"></a>WHOIS</td>
                <td id="getWhois"><?php print $ajaxPlaceholder ?></td>
            </tr>
            <tr>
                <td class='lbl'><a name="ipwhois"></a>IP Whois</td>
                <td id="getIpWhois"><?php print $ajaxPlaceholder ?></td>
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
            <tr>
                <td class="lbl">IP Geolocation (Via Telize)</td>
                 <td id="ipgeo"><?php print $ajaxPlaceholder ?></td>
            </tr>
        </table>

    </p>


    <script>



function ajaxCall(query, cssid){
    $.ajax({
  url: "?q=ajax&domain=<?php print $_GET['domain']?>&a="+query,
  beforeSend: function( xhr ) {
    xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
  }
})
  .done(function( data ) {
    $(cssid).html(data);
  });

}


$(document).ready(function(){
    ajaxCall('ip', '#getIp');
    ajaxCall('madwireSystem', '#getMadwire');
    ajaxCall('bcStyles', "#getBcStyle");
    ajaxCall('dnsA', "#getDnsA");
    ajaxCall('whois', "#getWhois");
    ajaxCall('dnsMX', "#getDNSMX");
    ajaxCall('ipWhois', "#getIpWhois");
    ajaxCall('cert', "#getCert");
    ajaxCall('ipgeo', "#ipgeo");
})


    </script>