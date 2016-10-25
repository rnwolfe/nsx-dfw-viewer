<?php
// get functions
require_once( "init.php" );
require_once( "functions.php" );

$url = "https://". $nsx_host ."/api/2.0/services/ipset/scope/globalroot-0";
$r = restCall("GET", $url, $nsx_auth, array( "Accept: application/json" ) );

print $r;

/* details of ip set:
Request:
GET https://<nsxmgr-ip>/api/2.0/services/ipset/<ipset-id>
*/
?>