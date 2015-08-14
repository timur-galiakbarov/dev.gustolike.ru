'use_strict';

angular.module('rad.pages').controller('pageDetailController', ['$scope', 'pageServerApi', '$stateParams', '$state', 'accountData', 'vkApi',
    function($scope, pageServerApi, $stateParams, $state, accountData, vkApi) {
        //Задаем пункт меню
        (function setItem() {
            $scope.$parent.menu = {};
            $scope.$parent.menu.pages = 'active';
        })();

        $scope.model = {
            pageId: '',
            inProcess: true,
            code: $stateParams.pageCode,
            isLogo: false,
            logoImgURL: '',
            isVk: false,
            pageBanner: false,
            pageBannerUrl: false,
            vkGroup: '',
            userId: null,
            useDescription: false,
            description: '',
            isMember: false,
        };

        pageServerApi.pages.getPage($scope.model.code, function(pageInfo){//Получаем информацию о текущей акции
            //console.log(pageInfo);
            $scope.model.pageId = pageInfo.data.id;
            if (pageInfo.data.logoImg){
                $scope.model.isLogo = true;
                $scope.model.logoImgURL = pageInfo.data.logoImg;
            }
            if (pageInfo.data.description){
                $scope.model.useDescription = true;
                $scope.model.description = pageInfo.data.description;
            }
            if (pageInfo.data.isVk == "1"){
                $scope.model.isVk = true;

                if (pageInfo.data.vkGroup) {
                    $scope.model.vkGroup = "http://vk.com/" + pageInfo.data.vkGroup;
                }
            }
            if (pageInfo.data.bannerURL){
                $scope.model.pageBanner = true;
                $scope.model.pageBannerUrl = pageInfo.data.bannerURL;
            }

        });

        //Устанавливаем активную вкладку
        $state.go(".balls");

    }]);