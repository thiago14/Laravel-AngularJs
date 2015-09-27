angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$scope', '$location','$routeParams', 'Project','Client', function ($scope, $location, $routeParams, Project, Client) {
        $scope.project = new Project();
        $scope.project.progress = 0;
        $scope.project.owner_id = $scope.user.id;
        $scope.clients = Client.query();

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.project.$save().then(function(){
                    $location.path('/projects');
                });
            }
        }
    }]);