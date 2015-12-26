angular.module('app.controllers')
    .controller('NavbarController', ['$rootScope', '$scope', '$cookies', 'OAuth',
        function ($rootScope, $scope, $cookies, OAuth) {

            if (OAuth.isAuthenticated()) {
                $rootScope.user = $cookies.getObject('user');
                $scope.showMenu = true;
            }
        }
    ]);