'use strict';
gustolikeApp.directive('content', radContent);

//radBalls.inject = ['accountData', 'vkApi', '$timeout'];

function radContent() {
    return {
        restrict: 'EA',
        templateUrl: 'js/content.html',
        controller: ['$rootScope', '$scope', function ($rootScope, $scope) {
            $scope.isAuth = false;
            if ($rootScope.isAuth == true){
                $scope.isAuth == true;
            }
        }]
    }
}