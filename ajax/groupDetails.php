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
// For debugging append &d to URI
if( ! $_GET['groupid'] || ! isset( $_GET['groupid']) ) {
	die("No Group ID provided.");
} else {
	// get functions
	require_once( "init.php" );
	require_once( "functions.php" );
	require_once( "auth.php" );

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