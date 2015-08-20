'use strict';
radPages.directive('radGoToGroup', radGoToGroup);

radGoToGroup.inject = ['pageServerApi', 'vkApi', '$timeout'];

function radGoToGroup(pageServerApi, vkApi, $timeout) {
    return {
        restrict: 'EA',
        templateUrl: 'js/ui/pages/directives/radGoToGroup/radGoToGroup.html',
        controller: ['$scope', function ($scope) {

        }],
        link: function($scope){
            $scope.isMemberProcess = true;
            $scope.calcId = null;
            pageServerApi.pages.isMemberPage($scope.model.code, function(result){
                if (result.data.isMember == "true")
                    $scope.isMember = true;
                else $scope.isMember = false;

                $scope.calcId = result.data.id;
                $scope.isMemberProcess = false;
            });

            $scope.memberAction = function(flag){
                /*тут должна быть проверка $scope.calcId и вывод сообщения об ошибке, если имеется*/
                pageServerApi.pages.isMemberAction($scope.calcId, flag, function(result){
                    //console.log(result);
                    if (result.isMember == "true")
                        $scope.isMember = true;
                    else $scope.isMember = false;
                });
            }
        }
    };
}