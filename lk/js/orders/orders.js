var radMessages = angular.module('rad.orders', []);

radMessages.controller('ordersController', ['$scope', 'accountData',
    function($scope, accountData) {
        $scope.$parent.menu = {};
        $scope.$parent.menu.orders = 'active';



    }]);