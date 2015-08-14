angular.module('rad.pages').controller('pagesController', ['$scope', '$state',
    function($scope, $state) {
        $scope.$parent.menu = {};
        $scope.$parent.menu.pages = 'active';

        $scope.goToPage = function(state){
            $state.go('page-detail', {pageCode: state});
        }
    }]);