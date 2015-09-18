angular.module('app.controllers')
    .controller('NoteRemoveController',
    ['$scope', '$location', '$routeParams', 'Note',
        function ($scope, $location, $routeParams, Note) {
            $scope.note = new Note.get({project_id: $routeParams.id, idNote: $routeParams.idNote});

            $scope.remove = function () {
                $scope.note.$delete().then(function () {
                    $location.path('/project/' + $routeParams.id + '/notes');
                });
            }
        }]);