angular.module('app.controllers')
    .controller('NoteListController', ['$scope', '$routeParams', 'Note', function ($scope, $routeParams, Note) {
        $scope.notes = Note.query();
        $scope.project_id = $routeParams.id;
    }]);