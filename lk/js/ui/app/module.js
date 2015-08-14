'use strict';
/*������������� ����������*/
var gustolikeApp = angular.module('gustolikeApp', [
    'ngSanitize',
    'rad.account',
    'rad.pages',
    'rad.messages',
    'rad.orders',
    'rad.settings',
    'rad.menu',
    'rad.pages',
    'login',
    'ui.router',
], function ($httpProvider) {
    httpProvider($httpProvider);
});

function httpProvider($httpProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    // �������������� ��������� transformRequest � $http-�������
    $httpProvider.defaults.transformRequest = [function (data) {
        /**
         * ������� �������; ����������� ������ � x-www-form-urlencoded ������.
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


