angular.module('app.controllers')
    .controller('ClientListController', ['$scope', 'Client', function ($scope, Client) {
        Client.query({
            orderBy: 'created_at',
            order: 'desc',
            limit: 8
            },function(response){
                $scope.clients = response.data;
                $scope.letters =_putLetter();
            }
        );
        $scope.client = {};
        $scope.letters = [];

        $scope.showClient = function (client) {
            $scope.client = client;
        };
        $scope.activeSidebar = function (client){
            if($scope.client.id == client.id)
                return true;
        };

        function _putLetter(){
            var letters = [];
            angular.forEach($scope.clients, function(cli){
                letters.push(cli.name.substr(0,1));
            });
            letters = _unique_letter(letters);
            return _optionArray(letters);
        }

        function _optionArray(array){
            return array.map(function(el){
                return {id: el, label: el};
            });
        }

        function _unique_letter(array){
            return array.filter(function(el, index, arr) {
                return index == arr.indexOf(el);
            });
        }

    }]);