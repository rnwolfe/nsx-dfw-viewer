'use strict';

// Define filter for determining the length of an object.
angular.
	module('core').
	filter('objLength', function() {
		return function(object) { 
			return Object.keys(object).length; 
		};
	});




/*
myApp.filter('objLength', function() { return function(object) { return Object.keys(object).length; } });
*/