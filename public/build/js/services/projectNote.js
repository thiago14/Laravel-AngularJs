angular.module('app.services')
    .service('Note', ['$resource', '$routeParams', 'appConfig',
        function ($resource, $routeParams, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:id/note/:idNote',
                {id: $routeParams.id, idNote: $routeParams.idNote}, {
                    update: {
                        method: 'PUT'
                    }
                });
        }]);