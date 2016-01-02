angular.module('app.services')
    .service('Client', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/client/:id', {id: '@id'},{
            update: {
                method: 'PUT'
            },
            query: {
                isArray: false
            },
            getLetters: {
                url: appConfig.baseUrl + '/client/searchLetters',
                method: 'GET',
                isArray: false
            },
            getClientByLetter: {
                url: appConfig.baseUrl + '/client/byLetter',
                method: 'POST',
                isArray: true
            }
        });
    }]);