'use strict';
radPages.directive('radViewRating', radViewRating);

radViewRating.inject = ['accountServerApi', 'pageServerApi', '$timeout'];

function radViewRating(accountServerApi, pageServerApi, $timeout) {
    return {
        restrict: 'EA',
        templateUrl: 'js/ui/pages/directives/radViewRating/radViewRating.html',
        controller: ['$scope', function ($scope) {

        }],
        link: function($scope){
            pageServerApi.pages.getMembersList($scope.model.pageId, function(data){
                $scope.userItems = data.data;
                //console.log(data);
            });
        }
    };
}