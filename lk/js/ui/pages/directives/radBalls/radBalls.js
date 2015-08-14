'use strict';
radPages.directive('radBalls', radBalls);

radBalls.inject = ['accountServerApi', 'vkApi', '$timeout'];

function radBalls(accountServerApi, vkApi, $timeout) {
    return {
        restrict: 'EA',
        templateUrl: 'js/pages/directives/radBalls/radBalls.html',
        controller: ['$scope', 'accountServerApi', 'vkApi', function ($scope, accountServerApi, vkApi) {

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
            accountServerApi.api.getUserSocInfo(function(data){
                vkApi.api.getUserInfo(data.data.userVkId, function(result){
                    $timeout(function(){//Минимальная задержка
                        $scope.model.vk.avatar = result.response[0].photo_200;
                        $scope.model.vk.fullName = result.response[0].first_name + " " + result.response[0].last_name;
                    }, 40)
                });
            });

            accountServerApi.api.getBallsInfo($scope.model.code, function(data){
                $scope.model.vk.likes = data.data.vkLikes?data.data.vkLikes:0;
                $scope.model.vk.reposts = data.data.vkReposts?data.data.vkReposts:0;
                $scope.model.vk.comments = data.data.vkComments?data.data.vkComments:0;
            });
        }
    };
}