angular.module('app.controllers')
    .controller('LoginController', ['$scope', '$location', 'OAuth', function($scope, $location, OAuth){
        $scope.user = {
            username: '',
            passowrd: ''
        };
        $scope.login = function(){
            OAuth.getAccessToken($scope.user)
                .then(
                function(){
                    $location.path('home');
                },
                function(){
                    alert('Login inválido!');
                });
        };
    }]);
