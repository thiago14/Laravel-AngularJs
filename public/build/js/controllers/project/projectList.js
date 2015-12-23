angular.module('app.controllers')
    .controller('ProjectListController', ['$scope', 'Project', 'appConfig', function ($scope, Project, appConfig) {

        $scope.status = appConfig.project.status;
        $scope.totalProjects = 0;
        $scope.projectsPerPage = 10;
        _getResultsPage(1);

        $scope.pagination = {
            current: 1
        };

        $scope.pageChanged = function(newPage) {
            _getResultsPage(newPage);
        };

        function _getResultsPage(pageNumber) {
            Project.query({
                page: pageNumber,
                limit: $scope.projectsPerPage
            }, function(response){
                $scope.projects = response.data;
                $scope.totalProjects = response.meta.pagination.total;
            });
        }
    }]);