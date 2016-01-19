'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:LogowanieCtrl
 * @description
 * # LogowanieCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('LogowanieCtrl', ['$scope', '$rootScope', '$location', 'Users', function ($scope, $rootScope, $location, Users) {
    $scope.currentUser = {
    	login: '',
    	domain: '',
    	password: ''
    };
    
    $rootScope.isAdmin = $rootScope.user.typ === 'ADMIN' ? true : false;
    $rootScope.isLibrarian = $rootScope.user.typ === 'BIBLIOTEKARZ' ? true : false;

    $scope.login = function (){
    	$rootScope.isLogged = true;
    	$rootScope.user.login = $scope.currentUser.login + '@' + $scope.currentUser.domain;
        Users.login({
            email: $scope.currentUser.login + '@' + $scope.currentUser.domain,
            pwd: $scope.currentUser.password
        }).then(function (result){
            if(result.success){
                $rootScope.isLogged = true;
                $rootScope.user = result.data;
                $location.path('/');
            } else {
                console.log(result.msg);
                $rootScope.errorDialog(result.msg);
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
        });
    };
    var init = function(){
        if($rootScope.isLogged){
            $location.path('/users/me');
        }
        $rootScope.watchSearch($scope);
    };
    init();
  }]);
