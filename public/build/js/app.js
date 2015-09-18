var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services']);

angular.module('app.controllers', ['ngMessages','angular-oauth2']);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', function(){
   var config = {
     baseUrl: 'http://localhost:8000'
   };

    return {
        config: config,
        $get: function(){
            return config;
        }
    }
});

app.config([
    '$routeProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
    $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: 'LoginController'
        })
        .when('/home', {
            templateUrl: 'build/views/home.html',
            controller: 'HomeController'
        })
        .when('/clients', {
            templateUrl: 'build/views/client/list.html',
            controller: 'ClientListController'
        }).when('/clients/new', {
            templateUrl: 'build/views/client/new.html',
            controller: 'ClientNewController'
        }).when('/clients/:id/edit', {
            templateUrl: 'build/views/client/edit.html',
            controller: 'ClientEditController'
        }).when('/clients/:id/edit', {
            templateUrl: 'build/views/client/edit.html',
            controller: 'ClientEditController'
        }).when('/clients/:id/remove', {
            templateUrl: 'build/views/client/remove.html',
            controller: 'ClientRemoveController'
        });

    OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'LavAngId',
        clientSecret: 'SeCrEt_WoRd',
        grantPath: 'oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }
    });
}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth){
    $rootScope.$on('oauth:error', function(event, rejection){

        $rootScope.error = {
            message: '',
            error: false
        }
        if('invalid_grant' === rejection.data.error){
            return;
        }

        if('invalid_token' === rejection.data.error){
            return OAuth.getRefreshToken();
        }
        $rootScope.error.error = true;
        $rootScope.error.message = rejection.data.error;
        return $window.location.href = '/#/login';
    });
}]);