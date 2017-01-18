<?php
/*
NSX DFW Viewer - A responsive tool for viewing the NSX Distributed Firewall policy.

Copyright (C) 2016
	Ryan Wolfe 	<rwolfe@force3.com, rn.wolfe@gmail.com>
	Force 3 	<force3.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
if( ! $_GET['appid'] || ! isset( $_GET['appid']) ) {
	die("No Application ID provided.");
} else {

	// get functions
	require_once( "init.php" );
	require_once( "functions.php" );
	require_once( "auth.php" );

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