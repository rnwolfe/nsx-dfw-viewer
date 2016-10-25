<?php
//database settings 
/*
$connect = mysqli_connect("hostname", "username", "password", "dbname");

$result = mysqli_query($connect, "select * from students");

$data = array();
*/
// Error reporting/displaying
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// get curl function
require_once( "functions.php" );

// Get NSX Security Policy
$nsx_host = "10.202.10.101";
$nsx_auth = base64_encode("admin:opendaylight123");

$groupURL = "https://". $nsx_host ."/api/2.0/services/policy/securitypolicy/all";
$nsxR = restCall("GET", $groupURL, $nsx_auth, array( "Accept: application/json" ) );

print $nsxR;
// print json_encode($data);
?>