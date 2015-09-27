angular.module('app.controllers')
    .controller('HomeController', ['$scope', '$cookies', function ($scope, $cookies) {
        console.log($cookies.getObject('user').id);
        console.log($cookies.getObject('user').email);
        console.log($cookies.getObject('user').name);
    }]);