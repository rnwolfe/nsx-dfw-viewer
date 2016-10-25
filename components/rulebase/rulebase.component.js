'use strict';

// Register `rulebase` component, along with its associated controller and template
angular.
	module('rulebase').
	component('rulebase', {
		templateUrl: 'components/rulebase/rulebase.template.html',
		controller: ['$http', function RulebaseController($http) {
				var self = this;

				$http.get('ajax/rulebase_ajax.php').
					success(function(data) {
						self.rulebase = data;
						console.log(self.rulebase);
					}).
					error(function() {
						self.rulebase = "error in fetching data";
					})
			}]
	});
/*


myApp.controller('controller', ['$scope', '$http', function ($scope, $http) {
    // Query for rulebase
    $http.get("ajax/rulebase_ajax.php")
        .success(function(data){
            $scope.rulebase = data;
            console.log($scope.rulebase);
        })
        .error(function() {
            $scope.rulebase = "error in fetching data";
        });
*/