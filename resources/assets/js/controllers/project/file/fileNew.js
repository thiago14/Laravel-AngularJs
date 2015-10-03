angular.module('app.controllers')
    .controller('FileNewController',
    ['$scope', '$location','$routeParams', 'File', function ($scope, $location, $routeParams, File) {
        $scope.file = new File();
        $scope.file.project_id = $routeParams.id;

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.file.$save().then(function(){
                    $location.path('/project/' + $routeParams.id + '/files');
                });
            }
        }
    }]);