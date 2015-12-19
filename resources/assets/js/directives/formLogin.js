angular.module('app.directives')
    .directive('formLogin',
        ['appConfig', function (appConfig) {
            return {
                restrict: 'E',
                templateUrl: appConfig.baseUrl + '/build/views/templates/formLogin.html'
            }
    }]);