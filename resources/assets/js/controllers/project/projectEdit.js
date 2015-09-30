angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope', '$location', '$routeParams', 'Project', 'Client',
        function ($scope, $location, $routeParams, Project, Client) {
            Project.get({id: $routeParams.id}, function (data) {
                $scope.project = data;
                Client.get({id: data.client_id}, function (data) {
                    $scope.project.client_id = data;
                })
            });

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.client_id = $scope.project.client_id.id;
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