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
        for (var category in response.categories) {
        	$scope.landCategories.push(response.categories[category]);
        }
    });

    $scope.launch = function (url) {
      var win = window.open(url, '_blank');
      win.focus();
    }
}]);