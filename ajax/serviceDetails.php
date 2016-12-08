<?php
if( ! $_GET['appid'] || ! isset( $_GET['appid']) ) {
	die("No Application ID provided.");
} else {

	// get functions
	require_once( "init.php" );
	require_once( "functions.php" );

	// Initialize array
	$services = array();
	$str = null;

	$appId = $_GET['appid'];
	$url = "https://". $nsx_host ."/api/2.0/services/application/". $appId;
	$json = restCall("GET", $url, $nsx_auth, array( "Accept: application/json" ) );
	$r = json_decode($json);

	if( $r->element->applicationProtocol ) $str .= $r->element->applicationProtocol;
	if( $r->element->value ) $str .= "/". $r->element->value;

	$services[] = $str;

	if( isset( $_GET['d'] ) ) {
		echo "<pre>";
		var_dump($r->element);
		echo $services;
		echo "</pre>";		
	}
	
	$services = json_encode( $services );

	print $services;	
}
?>