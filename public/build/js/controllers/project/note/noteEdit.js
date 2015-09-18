angular.module('app.controllers')
    .controller('NoteEditController',
    ['$scope', '$location', '$routeParams', 'Note',
        function ($scope, $location, $routeParams, Note) {
            $scope.note = new Note.get({project_id: $routeParams.id, idNote: $routeParams.idNote});

            $scope.save = function () {
                if ($scope.form.$valid) {
                    Note.update({id: $scope.note.id}, $scope.note, function () {
                        console.log('/project/' + $routeParams.id + '/notes');
                        $location.path('/project/' + $routeParams.id + '/notes');
                    });
                }
            }
        }]);