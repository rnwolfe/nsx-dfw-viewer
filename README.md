# NSX DFW Rule Viewer
This is simple web application for providing a more accessible web interface for the VMWare NSX Distribute Firewall.
## Table of Contents
1. [Purpose](#purpose)
2. [Changelog](#changelog)
3. [Requirements](#requirements)
4. [Pointing to NSX](#incorporating-into-a-new-nsx-manager)
5. [Frequently Asked Questions](#frequently-asked-questions-faqs)
6. [License](#license)
7. [Feedback & Contact](#feedback)

## Purpose
A couple of the main concerns I am looking to address are:
* Easy viewing and manipulation/filtering of large rulebases based on filters or sections.
* Deeper iteration through nested objects, e.g. a destination object that is a security group which contains an IP Set does not actually show the contents of the IP Set. The NSX GUI just shows the IP Set name that is embedded in the security group. This makes a quick glean of the information nearly impossible in those cases. This app properly recurses through nested objects. 
    * *Note: it currently only processes security groups and IP Sets.*
* Speed of use. The NSX interface can become prohibitively slow and the UI can be sticky and perform less than desirably. This interface is much more responsive. 

## Changelog
The following changes have been introduced in v0.2:
* Browser-based authentication based on the NSX Manager credentials.
* Filtering out rules that don't match the filter (as opposed to just the sections).

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
```
## Frequently Asked Questions (FAQs)
#### 1. How does the authentication work? 
No credentials are stored within the application's codebase. They are only gained when logging into the app and stored on a per-session basis. The browser prompts the user for a username and password using the `$_SERVER` PHP variables. Once provided, they are validated using a body-less REST API call to the NSX Manager to confirm an HTTP 200 OK status is received. If an HTTP 200 is not received, the user will continue to be prompted for credentials. The code used to implement this is simple, and can be viewed in `ajax/auth.php`.
#### 2. What are the best ways to further secure the application?
The app is a *read only application*. In other words, no REST API POST/PUT calls are used. This provides some inherent protection. There are a few ways we can ensure the app isn't used to abuse the system or, vicariously, NSX itself.

1. Configure the account used for the NSX API for Read Only access using [role-based access control](http://www.routetocloud.com/2014/10/nsx-role-based-access-control/). In the case that the credentials are retrieved by someone, using a read-only NSX account would prevent anyone from modifying any NSX configurations.
2. Configure [access control for the Apache](https://www.cyberciti.biz/faq/apache-restrict-access-based-on-ip-address-to-selected-directories/) directory to restrict the app from only being accessed by administrators by specifying an administrator subnet, or list of administrator machine IPs.
3. Using the NSX Distributed Firewall, restrict access to the server that houses this application to only administrator machines.
=======

1. Configure the account used for the NSX API for Read Only access using [role-based access control](http://www.routetocloud.com/2014/10/nsx-role-based-access-control/). In the case that the credentials are retrieved by someone, using a read-only NSX account would prevent anyone from modifying any NSX configurations.
2. Configure [access control for the Apache](https://www.cyberciti.biz/faq/apache-restrict-access-based-on-ip-address-to-selected-directories/) directory to restrict the app from only being accessed by administrators by specifying an administrator subnet, or list of administrator machine IPs.
3. Using the NSX Distributed Firewall, restrict access to the server that houses this application to only administrator machines.

#### 3. Can I change the authentication source?
Simply? No. Ultimately? Yes, by coding in your own or using server-based configurations. The app's provided authentication is ultimately relying upon the NSX Manager's authentication configuration. 
## License
This application is distributed under the [GNU AGPLv3 license](https://www.gnu.org/licenses/agpl-3.0.en.html).
## Feedback
Comments, problems, feature requests, and other feedback should be directed to [Ryan Wolfe](mailto:rwolfe@force3.com?subject=NSX DFW Viewer Feedback) (rwolfe@force3.com) at [Force 3](http://force3.com).

