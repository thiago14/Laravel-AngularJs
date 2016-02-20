angular.module('app.controllers')
    .controller('HomeController',
    ['$scope', '$cookies', '$filter', '$timeout', '$pusher', 'Project', 'Task', 'appConfig',
        function ($scope, $cookies, $filter, $timeout, $pusher, Project, Task, appConfig) {
            $scope.status = appConfig.project.status;
            $scope.totalProjects = 0;
            $scope.projectsPerPage = 6;
            $scope.date = new Date();

            Project.query({
                page: 1,
                limit: $scope.projectsPerPage
            }, function (response) {
                $scope.projects = response.data;
                $scope.project = $scope.projects[0];
                $scope.totalProjects = response.meta.pagination.total;
            });

            $scope.tasks = Task.query({
                orderBy: 'id',
                sortedBy: 'desc'
            });

            var pusher = $pusher(window.client),
                channel = pusher.subscribe('user.' + $cookies.getObject('user').id);
            channel.bind('GerenciadorProjetos\\Events\\TaskWasIncluded',
                function (data) {
                    if ($scope.tasks.length == 6) {
                        $scope.tasks.pop();
                    }
                    angular.merge(data.task, {type_event: 'incluída'});
                    $timeout(function () {
                        $scope.tasks.unshift(data.task);
                    }, 1000);
                }
            );

            channel.bind('GerenciadorProjetos\\Events\\TaskWasChanged',
                function (data) {
                    if ($scope.tasks.length == 6) {
                        $scope.tasks.pop();
                    }
                    angular.merge(data.task, {type_event: 'alterada'});
                    $timeout(function () {
                        $scope.tasks.unshift(data.task);
                    }, 1000);
                }
            );
        }
    ]
);