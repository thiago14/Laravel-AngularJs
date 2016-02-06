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
        $scope.filterLetter = [{id: '', label: 'Todos'}];
        Client.getLetters({}, function(response){
            $scope.letters = _optionArray(response);
        });

        $scope.activeSidebar = function (client){
            if($scope.client.id == client.id)
                return true;
        };

        $scope.filterClient = function(){
            Client.getClientByLetter({
                    letter: $scope.filterLetter.id
                },function(response){
                    $scope.clients = response;
                    $scope.client = $scope.clients[0];
                }
            );
        };

        $scope.showClient = function (client) {
            $scope.client = client;
        };

        function _optionArray(array){
            var options = [{id: '', label: 'Todos'}];
            angular.forEach(array.meta, function(option){
                options.push({id: option, label: option});
            });
            return options;
        }
    }]);