angular.module('app.controllers')
    .controller('FileRemoveController',
    ['$scope', '$location', '$routeParams', 'File',
        function ($scope, $location, $routeParams, File) {
            $scope.file = new File.get({id: $routeParams.id, idFile: $routeParams.idFile});

            $scope.remove = function () {
                var projectId = $scope.file.project_id;
                $scope.file.$delete({id: $scope.file.project_id, idFile: $scope.file.id}).then(function () {
                    $location.path('/project/' + projectId + '/files');
                });
            }
        }]);