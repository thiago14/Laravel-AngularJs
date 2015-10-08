angular.module('app.services')
    .service('File', ['$resource', '$routeParams', 'appConfig', function ($resource, $routeParams, appConfig) {
        var urlDefault = appConfig.baseUrl + '/project/:id/file/:idFile';
        return $resource(urlDefault, {id: $routeParams.id, idFile: $routeParams.idFile}, {
            update: {
                url: urlDefault,
                method: 'PUT'
            },
            download: {
                url: urlDefault + '/download',
                method: 'GET'
            }
        });
    }]);