var productScrollElement = document.querySelector('#apps');
var myOptiscrollInstance = new Optiscroll(productScrollElement, {
	forceScrollbars: true
});

var mainApp;

mainApp = angular.module('mainApp', []);

mainApp.controller('mainController', ['$scope', '$window', '$http', function($scope, $window, $http) {
	$http({
        method: "GET",
        url: "php/front-end_endpoint.php",
        params:{
        	data:'categories'
        }
    }).success(function(response){
        $scope.landCategories = [];
        for (var app in response) {
        	$scope.landCategories.push(response[app]);
        }
        console.log($scope.landCategories);
    });

    $http({
        method: "GET",
        url: "php/front-end_endpoint.php",
        params:{
        	data:'links'
        }
    }).success(function(response){
        $scope.links = [];
        for (var link in response) {
        	$scope.links.push(response[link]);
        }
        //console.log($scope.links);
    });
}]);