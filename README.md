# NSX DFW Rule Viewer
This is simple web application for providing a more accessible web interface for the VMWare NSX Distribute Firewall.
## Table of Contents
1. [Purpose](#purpose)
2. [Requirements](#requirements)
3. [Pointing to NSX](#incorporating-into-a-new-nsx-manager)
4. [Frequently Asked Questions](#frequently-asked-questions-faqs)

## Purpose
A couple of the main concerns I am looking to address are:
* Easy viewing and manipulation/filtering of large rulebases based on filters or sections.
* Deeper iteration through nested objects, e.g. a destination object that is a security group which contains an IP Set does not actually show the contents of the IP Set. It just shows the IP Set name that is embedded in the security group. This makes a quick glean of the information nearly impossible in those cases.
* Speed of use. The NSX interface can become prohibitively slow and the UI can be sticky and perform less than desirably. This interface is much more responsive. 

## Requirements
It is using PHP, AngularJS with UI Bootstrap, and, of course, HTML/CSS. It was built specifically with: 
* Server Side
    * PHP 7.0.0
    * Apache
* Client Side Frameworks
    * AngularJS v1.5.8 with - 
        * AngularJS Animate v1.5.8
        * AngularJS Sanitize v1.5.8
    * Bootstrap v3.3.7

## Incorporating into a New NSX Manager
The tool can be quickly and easily integrated into a new NSX environment by updating the `ajax/init.php` file as follows: 
``` php
$nsx_host = "10.11.12.13";
$nsx_auth = base64_encode("adminuser:adminpassword");
```
Additionally, you can simply base64 encode the string to slightly obfuscate the username and password.
``` php
$nsx_host = "10.11.12.13";
$nsx_auth = "YWRtaW51c2VyOmFkbWlucGFzc3dvcmQ=";
```
## Frequently Asked Questions (FAQs)
**1. What are the best ways to secure the application?**

You can modify the code to accomplish some additional security, but given the NSX API requires HTTP Basic Auth, the username and password must be base64 encoded. The app is a *read only application*, so no POST API are used. This provides some inherent protection. There are a few ways we can ensure the app isn't used to abuse the system or, vicariously, NSX itself.
1. Configure the account used for the NSX API for Read Only access using [role-based access control](http://www.routetocloud.com/2014/10/nsx-role-based-access-control/).
2. Configure [access control for the Apache](https://www.cyberciti.biz/faq/apache-restrict-access-based-on-ip-address-to-selected-directories/) directory to restrict the app from only being accessed by administrators by specifying an administrator subnet, or list of administrator machine IPs.
3. Using the NSX Distributed Firewall, restrict access to the server that houses this application to only administrator machines.
3. Configure authentication for the Apache server/directory (see FAQ#2).

Additionally, the PHP files that hold the NSX IP and credentials are obfuscated from the user by the simple fact that PHP won't be parsed in the browser. Only users with direct access to the files could get that information. In the case that the credentials are retrieved by someone, using a read-only NSX account would prevent anyone from modifying any NSX configurations.

**2. How can I add authentication?**

While authentication could be coded into the application itself, it is recommended to simply use Apache configurations to incorporate authentication. You can configure [simple password-based authentication](https://wiki.apache.org/httpd/PasswordBasicAuth), [LDAP authentication](http://www.held-im-ruhestand.de/software/apache-ldap-active-directory-authentication.html), [certificate-based authentication](https://httpd.apache.org/docs/current/ssl/ssl_howto.html#accesscontrol), and others using Apache configurations.
