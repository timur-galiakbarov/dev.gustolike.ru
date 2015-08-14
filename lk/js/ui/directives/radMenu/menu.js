radMenu = angular.module('rad.menu', []);

radMenu.directive('radAppMenu', radAppMenu);

radAppMenu.inject = ['rad.orders'];

function radAppMenu() {
    return {
        restrict: 'EA',
        templateUrl: 'js/ui/directives/radMenu/menu.html',
        controller: ['$scope', function ($scope) {

        }],
        link: function($scope){
            $scope.menu = {
                pages: 'active',
                orders: '',
                messages: '',
                settings: '',
            };

            $scope.clearActiveItem = function(){
                $scope.menu.pages = '';
                $scope.menu.orders = '';
                $scope.menu.messages = '';
                $scope.menu.settings = '';
            };

        }
    };
}

