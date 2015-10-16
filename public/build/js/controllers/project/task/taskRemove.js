angular.module('app.controllers')
    .controller('TaskRemoveController',
    ['$scope', '$location', '$routeParams', 'Task',
        function ($scope, $location, $routeParams, Task) {
            $scope.task = new Task.get({id: $routeParams.id, idTask: $routeParams.idTask});

            $scope.remove = function () {
                $scope.task.$delete({id: $scope.task.project_id, idTask: $scope.task.id}).then(function () {
                    $location.path('/project/' + $routeParams.id + '/tasks');
                });
            }
        }]);