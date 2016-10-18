<?php
// For debugging append &d to URI
if( ! $_GET['groupid'] || ! isset( $_GET['groupid']) ) {
	die("No Group ID provided.");
} else {
	// get functions
	require_once( "../init.php" );
	require_once( "../functions.php" );

	$addresses = array();

	$groupId = $_GET['groupid'];
	$url = "https://". $nsx_host ."/api/2.0/services/securitygroup/". $groupId ."/translation/ipaddresses";
	$json = restCall("GET", $url, $nsx_auth, array( "Accept: application/json" ) );
	// had to decode these contents to array in order to successfully reference the needed element. 
	// Not really sure why.. I think it is related to the [0] key.
	$r = json_decode($json, true);

	// Debugging
	if( isset( $_GET['d'] ) ) {
		echo "<pre>";
		print_r($r);
		echo "</pre>";
	}
	
	// We must go deeper.. (API result is heavily nested array for whatever reason).
	// There may be use cases that were not considered.
	foreach( $r['ipNodes'] as $key=>$value) {
		if( is_array( $value ) ) {
			foreach ( $value as $k=>$v ) {
				if( is_array( $v ) ) $addresses[] = $v[0];
			}
		} else {
			//$addresses[] = $value;
		}
	}

	if( isset( $_GET['d'] ) ) {
		echo "<pre>";
		print_r($addresses);
		echo "</pre>";
	}

	// Check if group had no members.
	if ( empty( $addresses ) ) $addresses[] = "No members.";

	$contents = json_encode( $addresses );
	print $contents;	
}

?>