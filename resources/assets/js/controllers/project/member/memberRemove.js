angular.module('app.controllers')
    .controller('MemberRemoveController',
    ['$scope', '$location', '$routeParams', 'Member',
        function ($scope, $location, $routeParams, Member) {
            $scope.member = new Member.get({id: $routeParams.id, idMember: $routeParams.idMember});

            $scope.remove = function () {
                $scope.member.member_ids = $scope.member.id;
                $scope.member.$del({id: $routeParams.id}, function (data) {
                    $location.path('/project/' + $routeParams.id + '/members');
                });
            }
        }]);