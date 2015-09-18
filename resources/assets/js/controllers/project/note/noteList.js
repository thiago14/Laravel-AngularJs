angular.module('app.controllers')
    .controller('NoteListController', ['$scope', 'Note', function ($scope, Note) {
        $scope.notes = Note.query();
    }]);