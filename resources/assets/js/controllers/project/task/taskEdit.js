angular.module('app.controllers')
    .controller('TaskEditController',
    ['$scope', '$location', '$routeParams', '$filter', 'Task', 'appConfig',
        function ($scope, $location, $routeParams, $filter, Task, appConfig) {
            Task.get({id: $routeParams.id, idTask: $routeParams.idTask}, function(data){
                $scope.task = data;
                $scope.task.start_date = new Date($scope.task.start_date);
                $scope.task.due_date = new Date($scope.task.due_date);
                $scope.status = appConfig.project.status;
            });

            $scope.date = [false,false];

            $scope.open = function($event, element){
                $scope.date[element] = true;
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.task.due_date = $filter('date')($scope.task.due_date,'yyyy-MM-dd');
                    $scope.task.start_date = $filter('date')($scope.task.start_date,'yyyy-MM-dd');
                    Task.update({id: $scope.task.project_id, idTask: $routeParams.idTask}, $scope.task, function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);