angular.module('app.controllers')
    .controller('ClientListController', ['$scope', 'Client', function ($scope, Client) {
        Client.query({
            orderBy: 'created_at',
            order: 'desc',
            limit: 8
            },function(response){
                $scope.clients = response.data;
            $scope.client = $scope.clients[0];
            }
        );
        Client.getLetters({}, function(response){
            $scope.letters = _optionArray(response);
        });

        $scope.showClient = function (client) {
            $scope.client = client;
        };
        $scope.activeSidebar = function (client){
            if($scope.client.id == client.id)
                return true;
        };

        function _optionArray(array){
            var options = [];
            angular.forEach(array.meta, function(option){
                options.push({id: option, label: option});
            });
            return options;
        }

    }]);