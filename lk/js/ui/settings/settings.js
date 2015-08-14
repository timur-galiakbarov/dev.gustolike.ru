var radSettings = angular.module('rad.settings', []);

radSettings.controller('settingsController', ['$scope',
    function($scope) {
        $scope.$parent.menu = {};
        $scope.$parent.menu.settings = 'active';
    }]);