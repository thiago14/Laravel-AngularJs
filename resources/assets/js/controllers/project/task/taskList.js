angular.module('app.controllers')
    .controller('TaskListController', ['$scope', '$routeParams', 'Task', function ($scope, $routeParams, Task) {
        $scope.tasks = Task.query();
        $scope.project_id = $routeParams.id;
    }]);