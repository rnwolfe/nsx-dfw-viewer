# NSX DFW Rule Viewer

This is currently a playground for building out a more accessible web interface for the VMWare NSX Distribute Firewall Policy.

A couple of the main concerns I am looking to address are:
* Easy viewing and manipulation/filtering of large rulebases based on filters or sections.
* Deeper iteration through nested objects, e.g. a destination object that is a security group which contains an IP Set does not actually show the contents of the IP Set. It just shows the IP Set name that is embedded in the security group. This makes a quick glean of the information nearly impossible in those cases.

## Current To Dos
1. Complete lookups of IP Sets and Security Groups, but be sure to only perform the needed lookup(s).
2. When Security Groups reference IP Sets, recurse into the IP Set to get member addresses.
3. Incorporate Angular UI.

## Tools
It is using PHP, AngularJS with UI Bootstrap, and, of course, HTML/CSS.
