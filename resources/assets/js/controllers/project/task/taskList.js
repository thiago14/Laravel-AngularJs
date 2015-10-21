angular.module('app.controllers')
    .controller('TaskListController', ['$scope', '$routeParams', 'Task', 'appConfig', function ($scope, $routeParams, Task, appConfig) {
        $scope.tasks = Task.query({id: $routeParams.id});
        $scope.status = appConfig.project.status;
        $scope.project_id = $routeParams.id;
    }]);