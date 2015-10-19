angular.module('app.services')
    .service('Member', ['$resource', '$routeParams', 'appConfig',
        function ($resource, $routeParams, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:id/member/:idMember', {id: $routeParams.id, idMember: $routeParams.idMember}, {
                del:{
                    url: appConfig.baseUrl + '/project/:id/member/remove',
                    method: 'POST'
                }
            });
        }]);