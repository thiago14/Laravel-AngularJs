angular.module('app.controllers')
    .controller('FileNewController',
    ['$scope', '$location', '$routeParams', 'appConfig', 'Url', 'Upload', function ($scope, $location, $routeParams, appConfig, Url, Upload) {

        $scope.save = function () {
            if ($scope.form.$valid) {
                Upload.upload({
                    url: appConfig.baseUrl + Url.getUrlFromUrlSymbol(appConfig.urls.projectFile, {
                        id: $routeParams.id,
                        idFile: ''
                    }),
                    fields: {
                        name: $scope.file.name,
                        description: $scope.file.description,
                        project_id: $routeParams.id
                    },
                    file: $scope.file.file
                }).success(function (data, status, headers, config) {
                    $location.path('/project/' + $routeParams.id + '/files');
                });
            }
        }
    }]);