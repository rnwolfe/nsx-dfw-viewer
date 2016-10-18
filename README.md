# NSX DFW Rule Viewer

This is currently a playground for building out a more accessible web interface for the VMWare NSX Distribute Firewall Policy.

A couple of the main concerns I am looking to address are:
* Easy viewing and manipulation/filtering of large rulebases based on filters or sections.
* Deeper iteration through nested objects, e.g. a destination object that is a security group which contains an IP Set does not actually show the contents of the IP Set. It just shows the IP Set name that is embedded in the security group. This makes a quick glean of the information nearly impossible in those cases.
* Speed of use. The NSX interface can become prohibitively slow and the UI can be sticky and perform less than desirably. This interface is much more responsive. 

## Current To Dos
1. ~~Complete lookups of IP Sets and Security Groups, but be sure to only perform the needed lookup(s).~~
2. ~~When Security Groups reference IP Sets, recurse into the IP Set to get member addresses.~~
3. Incorporate lookup of services and display in popover.
4. Correctly display "any" in place of empty source, destination, or service fields.
5. Incorporate Angular UI.

## Incorporating into a New NSX Manager
The tool can be quickly and easily integrated into a new NSX environment by updating the `init.php` file as follows: 
``` php
$nsx_host = "10.11.12.13";
$nsx_auth = base64_encode("adminuser:adminpassword");
```
## Tools
It is using PHP, AngularJS with UI Bootstrap, and, of course, HTML/CSS.
