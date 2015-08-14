radMenu = angular.module('rad.menu', []);

radMenu.directive('radAppMenu', radAppMenu);

radAppMenu.inject = ['rad.orders'];

function radAppMenu() {
    return {
        restrict: 'EA',
        templateUrl: 'js/menu.html',
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

            $scope.activeMenuItem = function(activeItem){
                //$scope.clearActiveItem();

                /*switch (activeItem){
                    case 'pages':{ $scope.menu.pages = 'active'; break;}
                    case 'orders':{ $scope.menu.orders = 'active'; break;}
                    case 'messages':{ $scope.menu.messages = 'active'; break;}
                    case 'settings':{ $scope.menu.settings = 'active'; break;}
                }*/
            };

        }
    };
}

