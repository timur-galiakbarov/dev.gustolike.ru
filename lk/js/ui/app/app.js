/**
 * Created by Тимур on 11.08.2015.
 */

gustolikeApp.run(['accountServerApi', '$state', '$rootScope',
    function (accountServerApi, $state, $rootScope) {
        accountServerApi.api.isAuth().then(function(result){
            if (result.success != true){
                location.href = '/signin';
            } else {
                $rootScope.isAuth = true;
            }
        });
    }]);