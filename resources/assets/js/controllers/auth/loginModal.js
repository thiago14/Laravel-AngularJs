angular.module('app.controllers')
    .controller('LoginModalController',
        ['$rootScope', '$scope', '$location', '$cookies', '$modalInstance', 'authService', 'User', 'OAuth', 'OAuthToken',
        function ($rootScope, $scope, $location, $cookies, $modalInstance, authService, User, OAuth, OAuthToken) {
            $scope.user = {
                username: '',
                password: '',
            };

            $scope.error = {
                message: '',
                error: false
            };

            $scope.$on('$routeChangeStart', function(){
                $modalInstance.close();
            });

            $scope.login = function () {
                if ($scope.formLogin.$valid) {
                    OAuth.getAccessToken($scope.user).then(function () {
                        User.authenticated({}, {}, function (data) {
                            $cookies.putObject('user', data);
                            authService.loginConfirmed();
                            $rootScope.loginModal = false;
                            $modalInstance.close();
                        });

                    }, function (data) {
                        $scope.error.error = true;
                        $scope.error.message = data.data.error_description;
                    });
                }
            };

            $scope.cancel = function(){
                authService.loginCancelled();
                OAuthToken.removeToken();
                $location.patch('login');
            };
    }]);