var app = angular.module('app', [
    'ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'app.directives',
    'angularUtils.directives.dirPagination', 'ngFileUpload', 'http-auth-interceptor', 'mgcrea.ngStrap.navbar', 'ngAnimate',
    'ui.bootstrap.typeahead', 'ui.bootstrap.tpls', 'ui.bootstrap.datepicker','ui.bootstrap.modal', 'ui.bootstrap.dropdown', 'ui.bootstrap.tabs'
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
                {value:0, label: 'Não iniciado', class: 'text-muted'},
                {value:1, label: 'Iniciado', class: 'text-info'},
                {value:2, label: 'Pausado', class: 'text-warning'},
                {value:3, label: 'Concluído', class: 'text-success'},
                {value:4, label: 'Atrasado', class: 'text-danger'},
            ]
        },
        task:{
            status: [
                {value:0, label: 'Incompleta'},
                {value:1, label: 'Completa'},
                {value:2, label: 'Pausada'},
            ]
        },
        urls: {
            projectFile: '/project/{{id}}/file/{{idFile}}',
        },
        utils: {
            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if (headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'application/json') {
                    var dataJson = JSON.parse(data);
                    if (dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1) {
                        dataJson = dataJson.data;
                    }
                    return dataJson
                }
                return data;
            }
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
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        $httpProvider.interceptors.splice(0, 2);
        $httpProvider.interceptors.push('oauthFixInterceptor');
        $routeProvider
            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'LoginController'
            }).when('/logout', {
                resolve: {
                    logout: ['$rootScope','$location', 'OAuthToken', function($rootScope, $location, OAuthToken){
                        OAuthToken.removeToken();
                        $rootScope.showMenu = false;
                        return $location.path('login');
                    }
                ]}
            }).when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'HomeController'
            }) // ------------------ Rotas de Clientes ------------------
            .when('/clients', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController',
                title: 'Clientes'
            }).when('/client/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController',
                title: 'Novo Cliente'
            }).when('/client/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController',
                title: 'Editar Cliente'
            }).when('/client/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController',
                title: 'Remover Cliente'
            })// ------------------ Rotas de Projetos ------------------
            .when('/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController',
                title: 'Projetos'
            }).when('/project/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController',
                title: 'Novo Projeto'
            }).when('/project/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController',
                title: 'Editar Projeto'
            }).when('/project/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController',
                title: 'Remover Projeto'
            }) // ------------------ Rotas de Notas ------------------
            .when('/project/:id/notes', {
                templateUrl: 'build/views/project/note/list.html',
                controller: 'NoteListController',
                title: 'Anotações'
            }).when('/project/:id/note/new', {
                templateUrl: 'build/views/project/note/new.html',
                controller: 'NoteNewController',
                title: 'Nova Anotação'
            }).when('/project/:id/note/:idNote/edit', {
                templateUrl: 'build/views/project/note/edit.html',
                controller: 'NoteEditController',
                title: 'Editar Anotação'
            }).when('/project/:id/note/:idNote/remove', {
                templateUrl: 'build/views/project/note/remove.html',
                controller: 'NoteRemoveController',
                title: 'Remover Anotação'
            })// ------------------ Rotas de Tarefas ------------------
            .when('/project/:id/tasks', {
                templateUrl: 'build/views/project/task/list.html',
                controller: 'TaskListController',
                title: 'Tarefas'
            }).when('/project/:id/task/new', {
                templateUrl: 'build/views/project/task/new.html',
                controller: 'TaskNewController',
                title: 'Nova Tarefa'
            }).when('/project/:id/task/:idTask/edit', {
                templateUrl: 'build/views/project/task/edit.html',
                controller: 'TaskEditController',
                title: 'Editar Tarefa'
            }).when('/project/:id/task/:idTask/remove', {
                templateUrl: 'build/views/project/task/remove.html',
                controller: 'TaskRemoveController',
                title: 'Remover Tarefa'
            })// ------------------ Rotas de Membros ------------------
            .when('/project/:id/members', {
                templateUrl: 'build/views/project/member/list.html',
                controller: 'MemberListController',
                title: 'Membros'
            }).when('/project/:id/member/:idMember/remove', {
                templateUrl: 'build/views/project/member/remove.html',
                controller: 'MemberRemoveController',
                title: 'Remover Membros'
            }) // ------------------ Rotas de Arquivos ------------------
            .when('/project/:id/files', {
                templateUrl: 'build/views/project/file/list.html',
                controller: 'FileListController',
                title: 'Arquivos'
            }).when('/project/:id/file/new', {
                templateUrl: 'build/views/project/file/new.html',
                controller: 'FileNewController',
                title: 'Novo Arquivo'
            }).when('/project/:id/file/:idFile/edit', {
                templateUrl: 'build/views/project/file/edit.html',
                controller: 'FileEditController',
                title: 'Editar Arquivo'
            }).when('/project/:id/file/:idFile/remove', {
                templateUrl: 'build/views/project/file/remove.html',
                controller: 'FileRemoveController',
                title: 'Remover Arquivo'
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

app.run(['$rootScope', '$location', '$cookies', '$http', '$modal', '$window', 'httpBuffer', 'OAuth',
    function ($rootScope, $location, $cookies, $http, $modal, $window, httpBuffer, OAuth) {

        $rootScope.$on('$routeChangeStart', function (event, next, current) {
            if(next.$$route.originalPath != '/login'){
                if (!OAuth.isAuthenticated()) {
                    $rootScope.rotaDepoisLogin = next.$$route.originalPath;
                    $location.path('login');
                }else{
                    $rootScope.showMenu = true;
                }
            }
        });

        $rootScope.goBack = function(){
            $window.history.back();
        };

        $rootScope.$on('$routeChangeSuccess', function(event, current){
            $rootScope.pageTitle = current.$$route.title;
        });

        $rootScope.$on('oauth:error', function(event, data){
            $rootScope.error = {
                message: '',
                error: false
            };

            if('invalid_grant' === data.rejection.data.error){
                return;
            }

            if('access_denied' === data.rejection.data.error){
                httpBuffer.append(data.rejection.config, data.defered);
                if(!$rootScope.isRefreshingToken){
                    $rootScope.isRefreshingToken = true;
                    return OAuth.getRefreshToken().then(function (response) {
                        $rootScope.isRefreshingToken = false;
                        return $http(data.rejection.config).then(function(response){
                            return data.deferred.resolve(response);
                        });
                    })
                }else{
                    return $http(data.rejection.config).then(function (response) {
                        return data.deferred.resolve(response);
                    })
                }
                return OAuth.getRefreshToken();
            }

            $rootScope.error.error = true;
            $rootScope.error.message = data.rejection.data.error;
            if(!$rootScope.loginModal){
                var modalInstance = $modal.open({
                    templateUrl: 'build/views/templates/loginModal.html',
                    controller: 'LoginModalController'
                });
                $rootScope.loginModal = true;
            }
            // return $location.path('login');
        });
    }
]);