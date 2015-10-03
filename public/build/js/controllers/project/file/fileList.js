angular.module('app.controllers')
    .controller('FileListController', ['$scope', 'File', function ($scope, File) {
        $scope.files = File.query();
    }]);