angular.module('app.controllers')
    .controller('MemberNewController',
    ['$scope', '$location','$routeParams', 'Member', 'appConfig', function ($scope, $location, $routeParams, Member, appConfig) {
        $scope.member = new Member();
        $scope.member.project_id = $routeParams.id;

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.member.$save().then(function(){
                    $location.path('/project/' + $routeParams.id + '/members');
                });
            }
        }
    }]);