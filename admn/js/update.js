var catScroll = document.querySelector('#apps');
var myOptiscrollInstance = new Optiscroll(catScroll, {
    forceScrollbars: true
});

var categoryEdScroll = document.querySelector('#catEdScroll');
var myOptiscrollInstance = new Optiscroll(categoryEdScroll, {
    forceScrollbars: true
});

var linksEdScroll = document.querySelector('#linksContainer');
var myOptiscrollInstance = new Optiscroll(linksEdScroll, {
    forceScrollbars: true
});

var mainApp;

mainApp = angular.module('mainApp', []);

mainApp.controller('mainController', ['$scope', '$window', '$http', function($scope, $window, $http) {
    
    $scope.getCategories = function () {
        $http({
            method: "GET",
            url: "/php/front-end_endpoint.php",
            params:{
                data:'categories'
            }
        }).success(function(response){
            $scope.landCategories = [];
            for (var app in response) {
                $scope.landCategories.push(response[app]);
            }
            $scope.editedCategory = $scope.landCategories[0];
        });
    }

    $scope.getLinks = function () {
        $http({
            method: "GET",
            url: "/php/front-end_endpoint.php",
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
    }

    $scope.categoryEditor = function (category) {
        $scope.editedCategory = category;
        var catEdt = document.querySelector("#catEd");
        catEdt.classList.toggle("catHidden");
        catEdt.classList.toggle("catVisible");

    };

    $scope.closeCatEditor = function () {
        var catEdt = document.querySelector("#catEd");
        catEdt.classList.toggle("catHidden");
        catEdt.classList.toggle("catVisible");
    }

    $scope.newApp = {
        name:"",
        image:"/img/outlook.png",
        link:"",
        description:""
    };

    $scope.addApp = function (app) {
        // body...
    };

    $scope.editApp = function (app) {
        /*we'll need
        edit method
        name of object we're editing app.name
        what is being edited e.g app.link*/
    }

    $scope.linkEditor = function () {
        var lnkEdt = document.getElementById("lnkEd");
        lnkEdt.classList.toggle("lnkHidden");
        lnkEdt.classList.toggle("lnkVisible");
    };

    $scope.showAddLink = function () {
        var addLnk = document.getElementById("newLink");
        addLnk.classList.toggle("newLinkV");
    }

    $scope.addLink = function () {
        // body...
        var data = {
            "name":$scope.name,
            "URL":$scope.url
        };
        //console.log(data);

        $http({
            method: "POST",
            url: "/admin/php/links-update.php",
            data: "links="+JSON.stringify(data),
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
            $scope.getLinks();
            $scope.name = '';
            $scope.url = '';
        });
    };
}]);

/*var form = document.getElementById("form");
var element = document.getElementById('uploadTarget');
var output = document.getElementById('output');
var input = document.createElement('input');
var xhr = new XMLHttpRequest();
var data = new FormData();
var url = 'php/upload.php';
var submit = document.getElementById("submit");

input.setAttribute('type', 'file');
input.setAttribute('name', 'files');
input.setAttribute('multiple', true);
input.style.display = 'none';

input.addEventListener('change', triggerCallback);
element.appendChild(input);

element.addEventListener('click', function() {
    input.value = null;
    input.click();
});

function triggerCallback(e) {
    var files;
    var filesArray = [];

    if(e.dataTransfer) {
        files = e.dataTransfer.files;

        //the files are in an object format.. this loop puts them in an array to be appended to formdata
        for (var key in files) {
            if(!files.hasOwnProperty(key))continue;
            filesArray.push(files[key])
        }

        //appends to form data
        for (var i = 0; i < files.length; i++) {
          data.append("files[]", filesArray[i]);
        }
      
    } else if(e.target) {
        files = e.target.files;

        //the files are in an object format.. this loop puts them in an array to be appended to formdata
        for (var key in files) {
            if(!files.hasOwnProperty(key))continue;
            filesArray.push(files[key])
        }

        for (var i = 0; i < files.length; i++) {
          data.append("files[]", filesArray[i]);
        }

    }

    callback(filesArray, data);
}

function callback(files, data) {
    // Here, we simply log the Array of files to the console.
    //console.log(data.getAll('files[]'));

    for(var i=0; i<files.length; i++) {
        if(files[i].type.indexOf('image/') === 0) {
            output.innerHTML += '<img width="200" src="' + URL.createObjectURL(files[i]) + '" />';
        }
        output.innerHTML += ;
    }
}

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }

    if (xhr.readyState != 4) {
        console.log("state was not 4, it was " + xhr.readyState);
    }
}


submit.addEventListener("click", function(){

    var imagesDescriptionArray = form.getElementsByClassName('imgDesc');
    var categoryArray = form.getElementsByClassName('productsMaindd');
    var subCategoryArray = form.getElementsByClassName('productsSubdd');
    var priceArray = form.getElementsByClassName('price');

    for (var i = 0; i < imagesDescriptionArray.length; i++) {
        data.append("description[]", imagesDescriptionArray[i].value);
        data.append("category[]", categoryArray[i].options[categoryArray[i].selectedIndex].value);
        data.append("subCategory[]", subCategoryArray[i].options[subCategoryArray[i].selectedIndex].value);
        data.append("price[]", priceArray[i].value);
    }

   //console.log(data.getAll('price[]'));

    xhr.open("POST", url, true);
    xhr.send(data);
});*/