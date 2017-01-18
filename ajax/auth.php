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
if ( ! isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    header('WWW-Authenticate: Basic realm="NSX View"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You must provide credentials in order to use this application.';
    exit;
} else {

    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}
?>