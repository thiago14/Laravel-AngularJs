angular.module('app.controllers')
    .controller('LoginController', ['$scope', '$location', '$cookies', 'User', '$rootScope', 'OAuth',
        function ($scope, $location, $cookies, User, $rootScope,OAuth) {
        $scope.user = {
            username: '',
            password: '',
        };

        $scope.error = {
            message: '',
            error: false
        };

        $scope.login = function () {
            if ($scope.formLogin.$valid) {
                OAuth.getAccessToken($scope.user).then(function () {
                    User.authenticated({}, {}, function(data){
                        $cookies.putObject('user', data);
                        $location.path($rootScope.rotaDepoisLogin);
                    });

                }, function (data) {
                    $scope.error.error = true;
                    $scope.error.message = data.data.error_description;
                });
            }
        };
    }]);