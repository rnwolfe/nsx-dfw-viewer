<?php
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