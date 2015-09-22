angular.module('app.controllers')
    .controller('NoteRemoveController',
    ['$scope', '$location', '$routeParams', 'Note',
        function ($scope, $location, $routeParams, Note) {
            $scope.note = new Note.get({project_id: $routeParams.id, idNote: $routeParams.idNote});

            $scope.remove = function () {
                var projectId = $scope.note.project_id;
                $scope.note.$delete({id: $scope.note.project_id, idNote: $scope.note.id}).then(function () {
                    $location.path('/project/' + projectId + '/notes');
                });
            }
        }]);