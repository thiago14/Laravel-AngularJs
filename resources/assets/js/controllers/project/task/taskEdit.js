angular.module('app.controllers')
    .controller('TaskEditController',
    ['$scope', '$location', '$routeParams', 'Task', 'appConfig',
        function ($scope, $location, $routeParams, Task, appConfig) {
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
                    Task.update({id: $scope.task.project_id, idTask: $routeParams.idTask}, $scope.task, function () {
                        $location.path('/projects');
                    });
                }
            }
        }]);