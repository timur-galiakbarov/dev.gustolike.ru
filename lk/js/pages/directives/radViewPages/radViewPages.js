var radPages = angular.module('rad.pages', []);

radPages.directive('radViewPages', radViewPages);

radViewPages.inject = ['$scope', 'pageServerApi', '$templateCache'];

function radViewPages($templateCache) {
    return {
        restrict: 'EA',
        templateUrl: 'js/pages/directives/radViewPages/pagesList.html',
        controller: ['$scope', 'pageServerApi', function ($scope, pageServerApi) {
            pageServerApi.pages.getList(viewPages);
            function viewPages(data){
                $scope.items = data.data;
                //console.log(data.data);
            }
        }],
        link: function($scope, serverApi){

        }
    };
}