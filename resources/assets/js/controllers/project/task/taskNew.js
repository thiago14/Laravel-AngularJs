angular.module('app.controllers')
    .controller('TaskNewController',
    ['$scope', '$location','$routeParams', 'Task', 'appConfig', function ($scope, $location, $routeParams, Task, appConfig) {
        $scope.task = new Task();
        $scope.task.project_id = $routeParams.id;
        $scope.status = appConfig.project.status;

        $scope.date = [false,false];

        $scope.open = function($event, element){
            $scope.date[element] = true;
        };

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.task.$save().then(function(){
                    $location.path('/project/' + $routeParams.id + '/tasks');
                });
            }
        }
    }]);