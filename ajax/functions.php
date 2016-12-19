<?php
/*
NSX DFW Viewer - A responsive tool for viewing the NSX Distributed Firewall policy.

Copyright (C) 2016
    Ryan Wolfe  <rwolfe@force3.com, rn.wolfe@gmail.com>
    Force 3     <force3.com>

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
// functions.php
function restCall($method, $url, $auth, $headers = array(), $port = false, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // TEMP --- DISABLE SSL VERIFICATION
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, $auth);

	// New Auth
	$headers[] = "Authorization: Basic ". $auth;

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // Request Port Number
    if( $port ) {
    	curl_setopt($curl, CURLOPT_PORT, $port);
    	// echo "Set port: $port!<br />";
    }

    // Headers
    if( $headers ) {
    	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    	// print "Added headers.<br />";
    	// print_r($headers);
    }

    $result = curl_exec($curl);

    // Error checking..
    if ($result === false) { die(curl_error($curl)); }

    curl_close($curl);

    return $result;
}
?>