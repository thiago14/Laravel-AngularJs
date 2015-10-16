var app = angular.module('app', [
    'ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'app.directives',
    'ui.bootstrap.typeahead', 'ui.bootstrap.tpls', 'ui.bootstrap.datepicker', 'ngFileUpload'
]);

angular.module('app.controllers', ['ngMessages', 'angular-oauth2']);
angular.module('app.filters', []);
angular.module('app.directives', []);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: 'http://localhost:8000',
        project:{
            status:[
                {value:1, label: 'Não iniciado'},
                {value:2, label: 'Iniciado'},
                {value:3, label: 'Pausado'},
                {value:4, label: 'Concluído'},
            ]
        },
        task:{
            status: [
                {value:1, label: 'Incompleta'},
                {value:2, label: 'Completa'},
                {value:3, label: 'Pausada'},
            ]
        },
        urls: {
            projectFile: '/project/{{id}}/file/{{idFile}}'
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
});

app.config([
    '$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
        $httpProvider.defaults.transformResponse = function (data, headers) {
            var headersGetter = headers();
            if (headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'application/json') {
                var dataJson = JSON.parse(data);
                if (dataJson.hasOwnProperty('data')) {
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
            }) // ------------------ Rotas de Clientes ------------------
            .when('/clients', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController'
            }).when('/client/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            }).when('/client/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            }).when('/client/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            })// ------------------ Rotas de Projetos ------------------
            .when('/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController'
            }).when('/project/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController'
            }).when('/project/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController'
            }).when('/project/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController'
            }) // ------------------ Rotas de Notas ------------------
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
            })// ------------------ Rotas de Tarefas ------------------
            .when('/project/:id/tasks', {
                templateUrl: 'build/views/project/task/list.html',
                controller: 'TaskListController'
            }).when('/project/:id/task/new', {
                templateUrl: 'build/views/project/task/new.html',
                controller: 'TaskNewController'
            }).when('/project/:id/task/:idTask/edit', {
                templateUrl: 'build/views/project/task/edit.html',
                controller: 'TaskEditController'
            }).when('/project/:id/task/:idTask/remove', {
                templateUrl: 'build/views/project/task/remove.html',
                controller: 'TaskRemoveController'
            }) // ------------------ Rotas de Arquivos ------------------
            .when('/project/:id/files', {
                templateUrl: 'build/views/project/file/list.html',
                controller: 'FileListController'
            }).when('/project/:id/file/new', {
                templateUrl: 'build/views/project/file/new.html',
                controller: 'FileNewController'
            }).when('/project/:id/file/:idFile/edit', {
                templateUrl: 'build/views/project/file/edit.html',
                controller: 'FileEditController'
            }).when('/project/:id/file/:idFile/remove', {
                templateUrl: 'build/views/project/file/remove.html',
                controller: 'FileRemoveController'
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

app.run(['$rootScope', '$window', '$location', '$cookies', 'OAuth',
    function ($rootScope, $window, $location, $cookies, OAuth) {

        if (OAuth.isAuthenticated()) {
            var user = $cookies.getObject('user');
            $rootScope.user = {
                id: user.id,
                name: user.name,
                email: user.email
            }
        }
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
            if (!OAuth.isAuthenticated()) {
                //Verifica se o usuário está autenticado
                //Guarda a rota que o usuário acessou
                $rootScope.rotaDepoisLogin = $location.path();
                //Redireciona para o login quebrando o histórico do browser, ou seja, o login não constará no histórico do browser
                $location.path('/login').replace();
            } else {
                $location.path($rootScope.postLogInRoute).replace();
                //OAuth.getRefreshToken();
                //Zera o rotaDepoisLogin
                $rootScope.rotaDepoisLogin = null;
            }
        });
    }
]);