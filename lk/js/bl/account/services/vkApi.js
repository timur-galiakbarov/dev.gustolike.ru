'use strict';
radAccount.factory('vkApi', vkApi);

vkApi.$inject = ['$http'];

function vkApi($http){
    var user = {
        isAuth: false
    };
    var api = {
        getUserInfo: function(userId, callback){
            $.ajax({
                type: "GET",
                url: "https://api.vk.com/method/users.get?fields=photo_200&user_ids="+userId,
                dataType: 'jsonp',
                success: function(result){
                    if (callback) callback(result);
                },
                error: function(result){
                    console.log("Произошла ошибка получения данных о пользователе ВК");
                }
            });
        }
    };

    return {
        api: api,
        user: user
    }
}
