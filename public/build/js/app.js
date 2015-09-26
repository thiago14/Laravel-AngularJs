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
    '$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
    $httpProvider.defaults.transformResponse = function(data, headers){
        var headersGetter = headers();
        if(headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'application/json' ){
            var dataJson = JSON.parse(data);
            if(dataJson.hasOwnProperty('data')){
                dataJson = dataJson.data;
            }
            return dataJson
        }
        return data;
    };
    $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: 'LoginController'
        }).when('/home', {
            templateUrl: 'build/views/home.html',
            controller: 'HomeController'
        }) // Rotas de Clientes
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
        }) // Rotas de Notas
        .when('/project/:id/notes', {
            templateUrl: 'build/views/project/note/list.html',
            controller: 'NoteListController'
        }).when('/project/:id/note/new', {
            templateUrl: 'build/views/project/note/new.html',
            controller: 'NoteNewController'
        }).when('/project/:id/note/:idNote/edit', {
            templateUrl: 'build/views/project/note/edit.html',
            controller: 'NoteEditController'
        }).when('/project/:id/note/:idNote/remove', {
            templateUrl: 'build/views/project/note/remove.html',
            controller: 'NoteRemoveController'
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

app.run(['$rootScope', '$window', '$location', 'OAuth', function($rootScope, $window, $location, OAuth){
    $rootScope.$on('oauth:error', function(event, rejection){

        $rootScope.error = {
            message: '',
            error: false
        };

        if('invalid_grant' === rejection.data.error){
            return;
        }

        if('invalid_token' === rejection.data.error){
            return OAuth.getRefreshToken();
        }
        //console.log(rejection.data.error);
        $rootScope.error.error = true;
        $rootScope.error.message = rejection.data.error;
        return $window.location.href = '#/login';
    });
    $rootScope.$on('$routeChangeStart', function (event, nextRoute, currentRoute) {
        //Verifica se o usuário está autenticado
        if (!OAuth.isAuthenticated()) {
            //Guarda a rota que o usuário acessou
            $rootScope.rotaDepoisLogin = $location.path();
            //Redireciona para o login quebrando o histórico do browser, ou seja, o login não constará no histórico do browser
                $location.path('/#/login').replace();
        } else {
            $location.path($rootScope.postLogInRoute).replace();
            //Zera o rotaDepoisLogin
            $rootScope.rotaDepoisLogin = null;
        }
    });
}]);