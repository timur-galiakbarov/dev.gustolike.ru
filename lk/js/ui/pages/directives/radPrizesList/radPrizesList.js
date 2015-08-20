'use strict';
radPages.directive('radPrizesList', radPrizesList);

radPrizesList.inject = ['pageServerApi'];

function radPrizesList(pageServerApi) {
    return {
        restrict: 'EA',
        templateUrl: 'js/ui/pages/directives/radPrizesList/radPrizesList.html',
        controller: ['$scope', 'pageServerApi', function ($scope, pageServerApi) {

        }],
        link: function($scope){
            pageServerApi.prizes.getList($scope.model.code, function(data){
                $scope.items = data.data;
                //console.log(data.data);
            });

        }
    };
}