angular.module('app.controllers')
    .controller('MemberListController', ['$scope', '$routeParams', 'User', 'Member', function ($scope, $routeParams, User, Member) {
        $scope.members = Member.query({id: $routeParams.id});
        $scope.member = new Member();
        $scope.project_id = $routeParams.id;

        $scope.save = function () {
            if ($scope.form.$valid) {
                $scope.member.member_ids = $scope.memberSelected.id;
                $scope.member.project_id = $scope.project_id;
                $scope.member.$save({id: $routeParams.id}).then(function () {
                    $scope.members = Member.query({id: $routeParams.id});
                    $scope.member = new Member();
                    $scope.memberSelected = '';
                });
            }
        };

        $scope.formatName = function (model) {
            if (model) {
                return model.name;
            }
            return ''
        };

        $scope.getMembers = function (name) {
            return User.query({
                search: name,
            }).$promise;

        };
    }]);