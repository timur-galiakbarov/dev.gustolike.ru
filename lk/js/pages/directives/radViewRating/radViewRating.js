'use strict';
radPages.directive('radViewRating', radViewRating);

radViewRating.inject = ['accountData', 'pageServerApi', '$timeout'];

function radViewRating(accountData, pageServerApi, $timeout) {
    return {
        restrict: 'EA',
        templateUrl: 'js/pages/directives/radViewRating/radViewRating.html',
        controller: ['$scope', function ($scope) {

        }],
        link: function($scope){
            pageServerApi.pages.getMembersList($scope.model.pageId, function(data){
                $scope.userItems = data.data;
                console.log(data);
            });
        }
    };
}