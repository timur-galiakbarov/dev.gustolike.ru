radPages.factory('pageServerApi', ['$http', function($http){
    var api = (function(){
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
        var pages = {//Акция
            getList: function(){//Список акций
                var defer = $.Deferred();
                $http.get("/engine/controllers/pages/getList.php").success(function (data) {
                    defer.resolve({success: data});
                }).error(function (data) {
                    defer.resolve({success: false});
                    console.log("Произошла ошибка получения списка акций");
                });
                return defer.promise();
            },
            getPage: function(code, callback){//Получение информации об акции
                $http.get("/engine/controllers/pages/getPage.php?code="+code).success(function (data) {
                    if (callback) callback(data);
                }).error(function (data) {
                    console.log("Произошла ошибка получения информации об акции");
                    if (callback) callback(data);
                });
            },
            isMemberPage: function(code, callback){
                $http.get("/engine/controllers/pages/isMemberPage.php?code="+code).success(function (data) {
                    if (callback) callback(data);
                }).error(function (data) {
                    console.log("Произошла ошибка получения данных о вступлении в акцию");
                    if (callback) callback(data);
                });
            },
            isMemberAction: function(id, flag, callback){
                $http.post("/engine/controllers/pages/includeMember.php", {elementId: id, isMember: flag}).success(function (data) {
                    if (callback) callback(data);
                }).error(function (data) {
                    console.log("Произошла ошибка при вступлении/выходе из акции");
                    if (callback) callback(data);
                });
            },
            getMembersList: function(pageId, callback){
                $http.get("/engine/controllers/pages/getMemberList.php?pageId="+pageId).success(function (data) {
                    if (callback) callback(data);
                }).error(function (data) {
                    console.log("Произошла ошибка получения списка подписчиков акции");
                    if (callback) callback(data);
                });
            }
        };
        var prizes = {
            getList: function(id, callback){
                $http.get("/engine/controllers/pages/getPrizesList.php?id="+id).success(function (data) {
                    if (callback) callback(data);
                }).error(function (data) {
                    console.log("Произошла ошибка при получении списка подарков");
                    if (callback) callback(data);
                });
            }
        };
        return {
            pages: pages,
            prizes: prizes,
        }
    })();
    return api;
}]);