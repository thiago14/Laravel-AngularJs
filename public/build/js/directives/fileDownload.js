angular.module('app.directives')
    .directive('fileDownload', ['$timeout','appConfig','File', function($timeout, appConfig, File) {
        return {
            restrict: 'E',
            templateUrl: appConfig.baseUrl + '/build/views/templates/fileDownload.html',
            link: function (scope, element, attr) {
                var anchor = element.children()[0];

                // When the download starts, disable the link
                scope.$on('download-start', function () {
                    $(anchor).attr('disabled', 'disabled');
                });

                // When the download finishes, attach the data to the link. Enable the link and change its appearance.
                scope.$on('downloaded', function (event, data) {
                    $(anchor).attr({
                        href: 'data:application-octet-stream;base64,' + data.file,
                        download: data.name + '.' + data.extension
                    })
                        //.removeAttr('disabled')
                        .text('Loading...')
                        .removeClass('btn-primary')
                        .addClass('btn-default');
                    $timeout(function(){
                        // Also overwrite the download pdf function to do nothing.
                        scope.downloadFile = function () {
                        };
                        $(anchor)[0].click();
                        $(anchor).text('Download')
                            .removeClass('btn-default')
                            .addClass('btn-primary')
                            .removeAttr('disabled');
                    });
                });
            },
            controller: ['$scope', '$attrs', '$http', function ($scope, $attrs, $http) {
                $scope.downloadFile = function () {
                    $scope.$emit('download-start');
                    File.download({id: $attrs.idProject, idFile: $attrs.idFile}, function(data){
                        $scope.$emit('downloaded', data);
                    });
                };
            }]
        }
    }]
);