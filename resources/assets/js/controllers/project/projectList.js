angular.module('app.controllers')
    .controller('ProjectListController', ['$scope', 'Project', 'appConfig', function ($scope, Project, appConfig) {

        $scope.status = appConfig.project.status;
        $scope.totalProjects = 0;
        $scope.projectsPerPage = 8;
        _getResultsPage(1);

        $scope.pagination = {
            current: 1
        };
        $scope.tab = 'detalhes';
        console.log();
        $scope.activeSidebar = function (project){
            if($scope.project.id == project.id)
                return true;
        };

        $scope.activeTab = function (tab){
            if($scope.tab == tab)
                return true;
        };

        $scope.pageChanged = function(newPage) {
            _getResultsPage(newPage);
        };

        $scope.showProject = function (project) {
            $scope.project = project;
        };

        function _getResultsPage(pageNumber) {
            Project.query({
                page: pageNumber,
                limit: $scope.projectsPerPage
            }, function(response){
                $scope.projects = response.data;
                $scope.project = $scope.projects[0];
                $scope.totalProjects = response.meta.pagination.total;
            });
        }
    }]);