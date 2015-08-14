var account = angular.module('account', ['rad.server']);
account.factory('accountData', accountData);

accountData.$inject = ['$location','$http'];

function accountData($location, $http){
    var user = {
        isAuth: false
    };
    var api = {
        isAuth: function(callback){
            return false;
        },
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
        }
    };

    return {
        api: api,
        user: user
    }
}

/*
account.controller('accountProtect', ['accountData', '$location', function(accountData, $location){
    accountData.api.isAuth(function(data){
        if (data.success != true){//Успешная авторизация
            accountData.user.isAuth = false;
            $location.path('/login')
            $location.replace();
        } else {
            accountData.user.isAuth = true;
        }
    });
}]);
*/

