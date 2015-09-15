var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.controllers']);

angular.module('app.controllers', ['ngMessages','angular-oauth2']);

app.config(['$routeProvider', 'OAuthProvider',function ($routeProvider, OAuthProvider) {
    $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: 'LoginController'
        })
        .when('/home', {
            templateUrl: 'build/views/home.html',
            controller: 'HomeController'
        });
    OAuthProvider.configure({
        baseUrl: 'http://localhost:8000',
        clientId: 'LavAngId',
        clientSecret: 'SeCrEt_WoRd',
        grantPath: 'oauth/access_token'
    });
}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth){
    $rootScope.$on('oauth.error', function(event, rejection){
        if('invalid_grant' === rejection.data.error){
            return;
        }

        if('invalid_token' === rejection.data.error){
            return OAuth.getRefreshToken();
        }

        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);