angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope', '$location', '$routeParams', 'Project', 'Client',
        function ($scope, $location, $routeParams, Project, Client) {
            Project.get({id: $routeParams.id}, function (data) {
                $scope.project = data;
                $scope.project.due_date = new Date($scope.project.due_date);
                Client.get({id: data.client_id}, function (data) {
                    $scope.clientSelected = data;
                })
            });

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
                    Project.update({id: $scope.project.id}, $scope.project, function () {
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
                if (name) {
                    return Client.query({
                        search: name,
                        searchFields: 'name:like'
                    }).$promise;
                }
            };
        }]);