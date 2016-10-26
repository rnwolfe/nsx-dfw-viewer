'use strict';

// Register `fieldContents` component, along with its associated controller and template
angular.
	module('fieldContents').
	component('fieldContents', {
		templateUrl: 'components/field-contents/field-contents.template.html',
		controller: ['$http', function FieldContentsController($http) {
				var self = this;

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

			    self.getContents = function(id, type) {
			        self.loading = true;
			        self.contents = null;

			        if(type == "SecurityGroup") {
			            self.getGroupValues(id);
			            //self.contents = self.groupItems;
			            console.log("it is an sg");
			        } else if(type == "IPSet") {
			            self.getSetValues(id);
			            //self.contents = self.ips;
			            console.log("it is an ipset");
			        }

			        console.log("contents:" );
			        console.log(self.contents);

			        self.loading = false;
			    }
			}]
	});
/*
    // Filter IPSets by given objectId
    self.getSetValues = function(id) {
        //self.ips = {};
        $http.get("ajax/ipsetDetails.php?setid=" + id )
            .success(function(data) {
                //console.log(data);
                self.contents = data;
            })
            .error(function() { 
                self.contents = ["error fetching ipset details"];
            })
    }

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
    self.getContents = function(id, type) {
        self.loading = true;
        self.contents = null;

        if(type == "SecurityGroup") {
            self.getGroupValues(id);
            //self.contents = self.groupItems;
            console.log("it is an sg");
        } else if(type == "IPSet") {
            self.getSetValues(id);
            //self.contents = self.ips;
            console.log("it is an ipset");
        }

        console.log("contents:" );
        console.log(self.contents);

        self.loading = false;
    }
*/
