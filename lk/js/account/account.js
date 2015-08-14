var account = angular.module('account', ['rad.server']);
account.factory('accountData', accountData);

accountData.$inject = ['serverApi','$location'];

function accountData(serverApi, $location){
    var user = {
        isAuth: false
    }
    var api = {
        isAuth: function(callback){
            return serverApi.isAuth(callback);
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
        getAvatarUrl: function(){

        }
    };

    return {
        api: api,
        user: user
    }
}

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


