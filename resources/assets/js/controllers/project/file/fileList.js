angular.module('app.controllers')
    .controller('FileListController', ['$scope', '$routeParams', 'File', function ($scope, $routeParams, File) {
        $scope.files = File.query({id: $routeParams.id});
        $scope.project_id = $routeParams.id;
    }]);