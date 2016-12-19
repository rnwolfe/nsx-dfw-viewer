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
'use strict';

// Register `rulebase` component, along with its associated controller and template
angular.
	module('rulebase').
	component('rulebase', {
		templateUrl: 'components/rulebase/rulebase.template.html',
		controller: ['$http', function RulebaseController($http) {
				var self = this;

				$http.get('ajax/rulebase.php').
					success(function(data) {
						self.rulebase = data;
						console.log(self.rulebase);
					}).
					error(function() {
						self.rulebase = "error in fetching data";
					})

				// Filter IPSets by given objectId
			    self.getSetValues = function(id) {
			        $http.get("ajax/ipsetDetails.php?setid=" + id )
			            .success(function(data) {
			                //console.log(data);
			                self.contents = data;
			            })
			            .error(function() { 
			                self.contents = ["error fetching ipset details"];
			            })
			    }
			    
			    // Filter Security Groups by given objectId
			    self.getGroupValues = function(id) {
			        $http.get("ajax/groupDetails.php?groupid=" + id )
			            .success(function(data) {
			                console.log(data);
			                self.contents = data;
			            })
			            .error(function() { 
			                self.contents = ["error fetching security group details"];
			            })
			    }

			    // Filter Services by given objectId
			    self.getServiceValues = function(id) {
			        $http.get("ajax/serviceDetails.php?appid=" + id )
			            .success(function(data) {
			                console.log(data);
			                self.contents = data;
			            })
			            .error(function() { 
			                self.contents = ["error fetching service details"];
			            })
			    }

			    // Get the contents of a field's item, and perform the required recursion
			    self.getContents = function(id, type) {
			        self.loading = true;
			        self.contents = null;

			        if(type == "SecurityGroup") {
			            self.getGroupValues(id);
			            console.log("it is an sg");
			        } else if(type == "IPSet") {
			            self.getSetValues(id);
			            console.log("it is an ipset");
			        } else if(type == "Application") {
			        	self.getServiceValues(id);
			        	console.log( id +" - it is a service");
			        }

			        console.log("contents:" );
			        console.log(self.contents);

			        self.loading = false;
			    }

			    self.isEmpty = function (obj) {
			        for (var i in obj) if (obj.hasOwnProperty(i)) return false;
			        return true;
			    }
			}]
	});