/**
 * Created by Тимур on 11.08.2015.
 */
'use strict';
gustolikeApp.config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("pages");
        //$urlRouterProvider.when('page-detail', '/contacts/:pageCode');
        $stateProvider
            .state('pages', {
                url: '/pages',
                templateUrl: 'js/ui/pages/controllers/pages.html',
                controller: 'pagesController',
            })
            .state('page-detail', {
                url: '/pages/:pageCode',
                templateUrl: 'js/ui/pages/controllers/detail.html',
                controller: 'pageDetailController',
            })
            .state('page-detail.balls', {
                templateUrl: 'js/ui/pages/controllers/balls.html',
            })
            .state('page-detail.shop', {
                templateUrl: 'js/ui/pages/controllers/shop.html',
            })
            .state('page-detail.rating', {
                templateUrl: 'js/ui/pages/controllers/rating.html',
            })
            .state('page-detail.about', {
                templateUrl: 'js/ui/pages/controllers/shop.html',
            })
            .state('page-detail.support', {
                templateUrl: 'js/ui/pages/controllers/shop.html',
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