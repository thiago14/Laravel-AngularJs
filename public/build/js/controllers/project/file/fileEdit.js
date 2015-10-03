angular.module('app.controllers')
    .controller('FileEditController',
    ['$scope', '$location', '$routeParams', 'File',
        function ($scope, $location, $routeParams, File) {
            $scope.file = new File.get({project_id: $routeParams.id, idFile: $routeParams.idFile});
            
            $scope.save = function () {
                if ($scope.form.$valid) {
                    File.update({id: $scope.file.project_id, idFile: $routeParams.idFile}, $scope.file, function () {
                        $location.path('/project/' + $scope.file.project_id + '/files');
                    });
                }
            }
        }]);