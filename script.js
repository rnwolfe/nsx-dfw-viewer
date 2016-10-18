var myApp = angular.module('fetch', ['ngAnimate', 'ui.bootstrap', 'ngSanitize']);

myApp.controller('controller', ['$scope', '$http', function ($scope, $http) {
    // Query for rulebase
    $http.get("rulebase_ajax.php")
        .success(function(data){
            $scope.rulebase = data;
            console.log($scope.rulebase);
        })
        .error(function() {
            $scope.rulebase = "error in fetching data";
        });

    // Query Security Groups
    $http.get("secgroups_ajax.php")
        .success(function(data){
            $scope.groups = data;
            console.log($scope.groups);
        })
        .error(function() {
            $scope.groups = "error in fetching data";
        });

    // Query IP Sets
    $http.get("ipsets_ajax.php")
        .success(function(data){
            $scope.ipsets = data;
            console.log($scope.ipsets);
        })
        .error(function() {
            $scope.ipsets = "error in fetching data";
        });

    myApp.filter('objLength', function() { return function(object) { return Object.keys(object).length; } });

    // Handle style of disabled objects
    $scope.if_disabled = function(status) {
            if(status) { 
                $scope.style = { 'color':'lightgrey', 'font-style':'italic' };
                return $scope.style;
            }
        }

    // Filter IPSets by given objectId
    $scope.getSetValues = function(id) {
        //$scope.ips = {};
        $http.get("ajax/ipsetDetails.php?setid=" + id )
            .success(function(data) {
                //console.log(data);
                $scope.contents = data;
            })
            .error(function() { 
                $scope.contents = ["error fetching ipset details"];
            })
    }

    $scope.getGroupValues = function(id) {
        $http.get("ajax/groupDetails.php?groupid=" + id )
            .success(function(data) {
                console.log(data);
                $scope.contents = data;
            })
            .error(function() { 
                $scope.contents = ["error fetching security group details"];
            })
    }

    $scope.getContents = function(id, type) {
        $scope.loading = true;
        $scope.contents = null;

        if(type == "SecurityGroup") {
            $scope.getGroupValues(id);
            //$scope.contents = $scope.groupItems;
            console.log("it is an sg");
        } else if(type == "IPSet") {
            $scope.getSetValues(id);
            //$scope.contents = $scope.ips;
            console.log("it is an ipset");
        }

        console.log("contents:" );
        console.log($scope.contents);

        $scope.loading = false;
    }

    // Convert comma-separated values to an array of items
    $scope.listToArray = function(values) {
        $scope.array = values.split(',');
        console.log($scope.array);
        return $scope.array;
    }

    $scope.isEmpty = function (obj) {
        for (var i in obj) if (obj.hasOwnProperty(i)) return false;
        return true;
    };
}]);