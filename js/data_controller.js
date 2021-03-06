var productScrollElement = document.querySelector('#apps');
var myOptiscrollInstance = new Optiscroll(productScrollElement, {
	forceScrollbars: true
});

var mainApp;

mainApp = angular.module('mainApp', []);

mainApp.controller('mainController', ['$scope', '$window', '$http', function($scope, $window, $http) {
    angular.element(document).ready(function () {
        var loadScreen = document.querySelector("#loading");
        loadScreen.classList.toggle("loading");
        loadScreen.classList.toggle("loaded");
        
        $http({
            method: "GET",
            url: "php/front-end_endpoint.php",
            params:{
                data:'categories'
            }
        }).success(function(response){
            $scope.landCategories = [];
            for (var category in response.categories) {
                response.categories[category].apps = $scope.toArray(response.categories[category].apps);
                $scope.landCategories.push(response.categories[category]);

                for(app in response.categories[category].apps){
                    response.categories[category].apps[app].links.urls = $scope.toArray(response.categories[category].apps[app].links.urls);
                    response.categories[category].apps[app].priority = parseInt(response.categories[category].apps[app].priority);
                }
            }
        });

        $scope.launch = function (url) {
          var win = window.open(url, '_blank');
          win.focus();
        }

        $scope.toArray = function (object) {
            var elementsArray = [];
            for(element in object){
                elementsArray.push(object[element]);
            }

            return elementsArray;
        }
    });
}]);