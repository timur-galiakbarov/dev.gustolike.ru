'use strict';
radAccount.factory('accountServerApi', accountApi);

accountApi.$inject = ['$location','$http'];

function accountApi($location, $http){
    var user = {
        isAuth: false
    };
    var api = {
        checkAuth: function(){
            api.isAuth(function(data){
                if (data.success != true){//Успешная авторизация
                    $location.path('/login')
                    $location.replace();
                }
            });
        },
        getFullName: function(){

        },
        getUserSocInfo: function(callback){
            $http.get("/engine/controllers/account/getUserSocInfo.php").success(function (data) {
                if (callback) callback(data);
            }).error(function (data) {//эмуляция обращения к серверу
                console.log("Произошла ошибка получения информации о ВК пользователя");
                if (callback) callback(data);
            });
        },
        getBallsInfo: function(code, callback){
            $http.get("/engine/controllers/account/getBallsInfo.php?code="+code).success(function (data) {
                if (callback) callback(data);
            }).error(function (data) {//эмуляция обращения к серверу
                console.log("Произошла ошибка получения информации о баллах пользователя");
                if (callback) callback(data);
            });
        },
        isAuth: function(){//Проверка на авторизацию пользователя
            var defer = $.Deferred();
            $http.get("/engine/controllers/isAuth.php").success(function (data) {
                defer.resolve({success: data.success});
            }).error(function (data) {//эмуляция обращения к серверу
                defer.resolve({success: false});
                console.log("Произошла ошибка получения сведений об авторизации");
            });
            return defer.promise();
        }

    };

    return {
        api: api,
        user: user
    }
}

