angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope', '$location', '$routeParams', '$window', 'Project', 'Client','appConfig',
        function ($scope, $location, $routeParams, $window, Project, Client, appConfig) {
            Project.get({id: $routeParams.id}, function (data) {
                $scope.project = data;
                var date = $scope.project.due_date.split('-');
                $scope.project.due_date = new Date(date[0],date[1]-1, date[2]);
                $scope.status = appConfig.project.status;
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
            $scope.error = {
                message: '',
                error: false
            };

            $scope.open = function($event){
                $scope.due_date.status.opened = true;
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.client_id = $scope.clientSelected.id;
                    Project.update({id: $scope.project.id}, $scope.project, function (response) {
                        if(!response.error)
                        {
                            $window.history.back()
                        }else {
                            $scope.error.error = true;
                            $scope.error.message = response.message;
                        }
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