angular.module('app.controllers')
    .controller('HomeController',
        ['$scope', '$cookies', '$filter', 'Project', 'appConfig', function ($scope, $cookies, $filter, Project, appConfig) {
        $scope.status = appConfig.project.status;
        $scope.totalProjects = 0;
        $scope.projectsPerPage = 6;
        $scope.date = new Date();

        Project.query({
            page: 1,
            limit: $scope.projectsPerPage
        }, function(response){
            $scope.projects = response.data;
            $scope.project = $scope.projects[0];
            $scope.totalProjects = response.meta.pagination.total;
        });
    }]);