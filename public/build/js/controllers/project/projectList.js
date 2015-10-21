angular.module('app.controllers')
    .controller('ProjectListController', ['$scope', 'Project', 'appConfig', function ($scope, Project, appConfig) {
        $scope.projects = Project.query();
        $scope.status = appConfig.project.status;
    }]);