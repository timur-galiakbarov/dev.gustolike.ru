'use strict';
/*Инициализация приложения*/
var gustolikeApp = angular.module('gustolikeApp', [
    'ngRoute',
    'ngSanitize',
    'account',
    'rad.pages',
    'rad.messages',
    'rad.orders',
    'rad.settings',
    'rad.menu',
    'rad.server',
    'login',
    'ui.router',
], function ($httpProvider) {
    httpProvider($httpProvider);
});

gustolikeApp.run(['serverApi', '$state', '$rootScope',
    function (serverApi, $state, $rootScope) {
        serverApi.api.isAuth().then(function(result){
            if (result.success != true){
                location.href = '/signin';
            } else {
                $rootScope.isAuth = true;
            }
        });
    }]);


function httpProvider($httpProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    // Переопределяем дефолтный transformRequest в $http-сервисе
    $httpProvider.defaults.transformRequest = [function (data) {
        /**
         * рабочая лошадка; преобразует объект в x-www-form-urlencoded строку.
         * @param {Object} obj
         * @return {String}
         */
        var param = function (obj) {
            var query = '';
            var name, value, fullSubName, subValue, innerObj, i;

            for (name in obj) {
                value = obj[name];

                if (value instanceof Array) {
                    for (i = 0; i < value.length; ++i) {
                        subValue = value[i];
                        fullSubName = name + '[' + i + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if (value instanceof Object) {
                    for (subName in value) {
                        subValue = value[subName];
                        fullSubName = name + '[' + subName + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if (value !== undefined && value !== null) {
                    query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
                }
            }

            return query.length ? query.substr(0, query.length - 1) : query;
        };

        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
}

gustolikeApp.config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("pages");
        //$urlRouterProvider.when('page-detail', '/contacts/:pageCode');
        $stateProvider
            .state('pages', {
                url: '/pages',
                templateUrl: 'js/pages/controllers/pages.html',
                controller: 'pagesController',
            })
            .state('page-detail', {
                url: '/pages/:pageCode',
                templateUrl: 'js/pages/controllers/detail.html',
                controller: 'pageDetailController',
            })
            .state('page-detail.balls', {
                templateUrl: 'js/pages/controllers/balls.html',
            })
            .state('page-detail.shop', {
                templateUrl: 'js/pages/controllers/shop.html',
            })
            .state('page-detail.rating', {
                templateUrl: 'js/pages/controllers/rating.html',
            })
            .state('page-detail.about', {
                templateUrl: 'js/pages/controllers/shop.html',
            })
            .state('page-detail.support', {
                templateUrl: 'js/pages/controllers/shop.html',
            })
            .state('orders', {
                url: '/orders',
                templateUrl: 'templates/orders/orders.html',
                controller: 'ordersController',
            })
            .state('messages', {
                url: '/messages',
                templateUrl: 'templates/messages/messages.html',
                controller: 'messagesController',
            })
            .state('settings', {
                url: '/settings',
                templateUrl: 'templates/settings/settings.html',
                controller: 'settingsController',
            })
            .state('login', {
                url: '/login',
                templateUrl: 'templates/login/notAuth.html',
                controller: 'loginNotAuthController',
            });
        //$locationProvider.html5Mode(true);
    }]);
