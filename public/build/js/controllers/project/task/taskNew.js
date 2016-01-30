angular.module('app.controllers')
    .controller('TaskNewController',
    ['$scope', '$location','$routeParams', '$filter', 'Task', 'appConfig', function ($scope, $location, $routeParams, $filter, Task, appConfig) {
        $scope.task = new Task();
        $scope.task.project_id = $routeParams.id;
        $scope.status = appConfig.project.status;

        $scope.date = [false,false];

        $scope.open = function($event, element){
            $scope.date[element] = true;
        };

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.task.due_date = $filter('date')($scope.task.due_date,'yyyy-MM-dd');
                $scope.task.start_date = $filter('date')($scope.task.start_date,'yyyy-MM-dd');
                $scope.task.$save().then(function(){
                    $location.path('/project/' + $routeParams.id + '/tasks');
                });
            }
        }
    }]);