angular.module('app.controllers')
    .controller('NoteEditController',
    ['$scope', '$location', '$routeParams', 'Note',
        function ($scope, $location, $routeParams, Note) {
            $scope.note = new Note.get({project_id: $routeParams.id, idNote: $routeParams.idNote});
            //console.log($scope.note);
            $scope.save = function () {
                if ($scope.form.$valid) {
                    Note.update({id: $scope.note.project_id, idNote: $routeParams.idNote}, $scope.note, function () {
                        console.log('/project/' + $routeParams.id + '/notes');
                        $location.path('/project/' + $scope.note.project_id + '/notes');
                    });
                }
            }
        }]);