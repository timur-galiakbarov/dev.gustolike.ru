var radMessages = angular.module('rad.messages', []);

radMessages.controller('messagesController', ['$scope',
    function($scope) {
        $scope.$parent.menu = {};
        $scope.$parent.menu.messages = 'active';
    }]);