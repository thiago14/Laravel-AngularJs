angular.module('app.controllers')
    .controller('NoteListController', ['$scope', '$routeParams', 'Note', function ($scope, $routeParams, Note) {
        $scope.notes = Note.query({id: $routeParams.id});
        $scope.project_id = $routeParams.id;
    }]);