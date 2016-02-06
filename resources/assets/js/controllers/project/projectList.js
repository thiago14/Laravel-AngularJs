angular.module('app.controllers')
    .controller('ProjectListController', ['$scope', 'Project', 'Member', 'User', 'appConfig', function ($scope, Project, Member, User, appConfig) {

        $scope.status = appConfig.project.status;
        $scope.totalProjects = 0;
        $scope.projectsPerPage = 8;
        $scope.urlImage = 'build/images/icons/ico-';
        _getResultsPage(1);

        $scope.pagination = {
            current: 1
        };
        $scope.tab = 'detalhes';
        $scope.activeSidebar = function (project){
            if($scope.project.id == project.id)
                return true;
        };

        $scope.activeTab = function (tab){
            if($scope.tab == tab)
                return true;
        };

        $scope.allProject = function(){
            $scope.all = !$scope.all;
            $scope.pageChanged(1);
        };

        $scope.pageChanged = function(newPage) {
            if($scope.all)
            {
                _getAllResultsPage(newPage);
            }else{
                _getResultsPage(newPage);
            }
        };

        $scope.showProject = function (project) {
            $scope.project = project;
        };

        function _getAllResultsPage(pageNumber) {
            Project.query({
                page: pageNumber,
                limit: $scope.projectsPerPage
            }, function(response){
                $scope.projects = response.data;
                $scope.project = $scope.projects[0];
                $scope.totalProjects = response.meta.pagination.total;
            });
        }

        function _getResultsPage(pageNumber) {
            Project.query({
                page: pageNumber,
                owner: 1,
                limit: $scope.projectsPerPage
            }, function(response){
                $scope.projects = response.data;
                $scope.project = $scope.projects[0];
                $scope.totalProjects = response.meta.pagination.total;
            });
        }

        $scope.member = new Member();

        $scope.save = function () {
            if ($scope.form.$valid) {
                $scope.member.member_ids = $scope.memberSelected.id;
                $scope.member.project_id = $scope.project.id;
                $scope.member.$save({id: $scope.project.id}).then(function () {
                    $scope.project.members.data = Member.query({id: $scope.project.id});
                    $scope.member = new Member();
                    $scope.memberSelected = '';
                });
            }
        };

        $scope.formatName = function (model) {
            if (model) {
                return model.name;
            }
            return ''
        };

        $scope.getMembers = function (name) {
            return User.query({
                search: name,
            }).$promise;

        };
    }]);