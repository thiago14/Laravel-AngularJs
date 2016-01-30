angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$rootScope', '$scope', '$location', '$routeParams','$filter', 'Project', 'Client', 'appConfig',
        function ($rootScope, $scope, $location, $routeParams, $filter, Project, Client, appConfig) {
        $scope.clients;
        $scope.project = new Project();
        $scope.project.progress = 0;
        $scope.project.owner_id = $rootScope.user.id;
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
                $scope.project.due_date = $filter('date')($scope.project.due_date,'yyyy-MM-dd');
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

            Client.query({
                search: name
            }, function(response){
                $scope.clients = response.data;
            });
            return $scope.clients;
        };
    }]);