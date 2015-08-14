radPages.directive('radViewPages', radViewPages);

radViewPages.inject = ['$scope', 'pageServerApi', '$templateCache'];

function radViewPages($templateCache) {
    return {
        restrict: 'EA',
        templateUrl: 'js/ui/pages/directives/radViewPages/pagesList.html',
        controller: ['$scope', 'pageServerApi', function ($scope, pageServerApi) {

            pageServerApi.pages.getList().then(function(data){
                if (data.success)
                    $scope.items = data.success.data;
            });
        }],
        link: function($scope, serverApi){

        }
    };
}