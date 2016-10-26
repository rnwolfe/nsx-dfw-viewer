'use strict';

// Register `ipset` component, along with its associated controller and template
angular.
    module('fieldContents.ipsets').
    component('ipsets', {
        controller: ['$http', function IpSetsController($http) {
                var self = this;
                // Filter IPSets by given objectId
                self.getSetValues = function(id) {
                    $http.get("ajax/ipsetDetails.php?setid=" + id )
                        .success(function(data) {
                            self.contents = data;
                        })
                        .error(function() { 
                            self.contents = ["error fetching ipset details"];
                        })
                }
            }]
    });