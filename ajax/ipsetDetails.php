<?php
if( ! $_GET['setid'] || ! isset( $_GET['setid']) ) {
	die("No Set ID provided.");
} else {

// get functions
require_once( "init.php" );
require_once( "functions.php" );

// initialize var(s)
$ipsetId = array();

	$ipsetId = $_GET['setid'];
	$url = "https://". $nsx_host ."/api/2.0/services/ipset/". $ipsetId;
	$json = restCall("GET", $url, $nsx_auth, array( "Accept: application/json" ) );
	$r = json_decode($json);
	
	if( isset( $_GET['d'] ) ) {
		echo "<pre>";
		var_dump($r);
		echo "</pre>";		
	}
	
	$contents = json_encode( explode(',', $r->value) );

	 print $contents;	
}
?>