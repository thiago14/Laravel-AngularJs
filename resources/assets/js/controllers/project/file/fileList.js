angular.module('app.controllers')
    .controller('FileListController', ['$scope', '$routeParams', 'File', function ($scope, $routeParams, File) {
        console.log($routeParams.id);
        $scope.files = File.query();
    }]);