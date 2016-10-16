<?php
// get functions
require_once( "init.php" );
require_once( "functions.php" );

$url = "https://". $nsx_host ."/api/4.0/firewall/globalroot-0/config";
$r = restCall("GET", $url, $nsx_auth, array( "Accept: application/json" ) );

print $r;
?>