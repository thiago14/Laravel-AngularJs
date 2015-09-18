angular.module('app.controllers')
    .controller('NoteNewController',
    ['$scope', '$location','$routeParams', 'Note', function ($scope, $location, $routeParams, Note) {
        $scope.note = new Note();
        $scope.note.project_id = $routeParams.id;

        $scope.save = function(){
            if($scope.form.$valid){
                $scope.note.$save().then(function(){
                    $location.path('/project/' + $routeParams.id + '/notes');
                });
            }
        }
    }]);