angular.module('app.services')
    .service('Task', ['$resource', '$routeParams', 'appConfig',
        function ($resource, $routeParams, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:id/task/:idTask',
                {id: $routeParams.id, idTask: $routeParams.idTask}, {
                    update: {
                        method: 'PUT'
                    }
                });
        }]);