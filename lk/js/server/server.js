angular.module('rad.server').factory('serverApi', ['$http', function($http){
    var api = (function(){
        var isAuth = function(callback){//Проверка на авторизацию пользователя
            $http.get("/engine/controllers/isAuth.php").success(function (data) {
                if (callback) callback(data);
            }).error(function (data) {//эмуляция обращения к серверу
                console.log("Произошла ошибка получения сведений об авторизации");
                if (callback) callback(data);
            });
        };
        return {
            isAuth: isAuth,
        }
    })();
    return api;
}]);