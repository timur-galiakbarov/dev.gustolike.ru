'use strict';
radPages.directive('radBalls', radBalls);

radBalls.inject = ['accountData', 'vkApi', '$timeout'];

function radBalls(accountData, vkApi, $timeout) {
    return {
        restrict: 'EA',
        templateUrl: 'js/pages/directives/radBalls/radBalls.html',
        controller: ['$scope', 'accountData', 'vkApi', function ($scope, accountData, vkApi) {

        }],
        link: function($scope){
            $scope.model.vk ={
                avatar: '',
                fullName: '',
                likes: 0,
                reposts: 0,
                comments: 0,
            };
            //Получаем информацию о пользователе ВК
            accountData.api.getUserSocInfo(function(data){
                vkApi.api.getUserInfo(data.data.userVkId, function(result){
                    $timeout(function(){//Минимальная задержка
                        $scope.model.vk.avatar = result.response[0].photo_200;
                        $scope.model.vk.fullName = result.response[0].first_name + " " + result.response[0].last_name;
                    }, 40)
                });
            });

            accountData.api.getBallsInfo($scope.model.code, function(data){
                $scope.model.vk.likes = data.data.vkLikes?data.data.vkLikes:0;
                $scope.model.vk.reposts = data.data.vkReposts?data.data.vkReposts:0;
                $scope.model.vk.comments = data.data.vkComments?data.data.vkComments:0;
            });
        }
    };
}