angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$scope', '$location', '$routeParams','$filter', 'Project', 'Client', 'appConfig',
        function ($scope, $location, $routeParams, $filter, Project, Client, appConfig) {
        $scope.project = new Project();
        $scope.project.progress = 0;
        $scope.project.owner_id = $scope.user.id;
        $scope.status = appConfig.project.status;

        $scope.now = new Date();
        $scope.due_date = {
            status: {
                opened: false
            }
        };

        $scope.open = function($event){
            $scope.due_date.status.opened = true;
        };

        $scope.save = function () {
            if ($scope.form.$valid) {
                $scope.project.client_id = $scope.clientSelected.id;
                $scope.due_date = $filter('date')($scope.due_date,'yyy-MM-dd');
                $scope.project.$save().then(function () {
                    $location.path('/projects');
                });
            }
        };

        $scope.formatName = function (model) {
            if (model) {
                return model.name;
            }
            return ''
        };

        $scope.getClients = function (name) {
            return Client.query({
                search: name,
            }).$promise;

        };
    }]);